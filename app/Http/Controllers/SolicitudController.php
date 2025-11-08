<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Anulacion;
use App\Models\Solicitud;
use App\Models\Validacion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudCreadaNotification;
use Illuminate\Validation\ValidationException;

class SolicitudController extends Controller
{
    public function store(Request $request)
    {
        // dd(request()->all());
        $userId = Auth::id();
        Log::info("El usuario con ID {$userId} está intentando crear una nueva solicitud.");

        try {
            // 1️⃣ Validación con mensajes en español
            $validated = $request->validate([
                'id_barrio' => 'required',
                'direccion' => 'required|string|min:3',
                'lat' => 'nullable|numeric',
                'lng' => 'nullable|numeric',
                'cedula' => 'required|file|mimes:pdf,jpeg,jpg,png|max:10240',
                'recibo' => 'required|file|mimes:pdf,jpeg,jpg,png|max:10240',
                'fileElectoral' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:10240',
                'fileSisben' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:10240',
                'fileJAC' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:10240',
                'terminos' => 'required',
                'observaciones' => 'nullable|string',
            ], [
                // Mensajes personalizados en español
                'id_barrio.required' => 'Debes seleccionar un barrio o vereda.',
                'direccion.required' => 'La dirección es obligatoria.',
                'direccion.min' => 'La dirección debe tener al menos 3 caracteres.',
                'cedula.required' => 'Debes adjuntar la fotocopia de tu cédula.',
                'cedula.file' => 'La cédula debe ser un archivo válido.',
                'cedula.mimes' => 'La cédula debe ser un archivo PDF, JPG, PNG o JPEG.',
                'cedula.max' => 'La cédula no puede pesar más de 10MB.',
                'recibo.required' => 'Debes adjuntar el recibo de servicios públicos.',
                'recibo.file' => 'El recibo debe ser un archivo válido.',
                'recibo.mimes' => 'El recibo debe ser un archivo PDF, JPG, PNG o JPEG.',
                'recibo.max' => 'El recibo no puede pesar más de 10MB.',
                'fileElectoral.file' => 'El certificado electoral debe ser un archivo válido.',
                'fileElectoral.mimes' => 'El certificado electoral debe ser PDF, JPG, PNG o JPEG.',
                'fileElectoral.max' => 'El certificado electoral no puede pesar más de 10MB.',
                'fileSisben.file' => 'La constancia del Sisbén debe ser un archivo válido.',
                'fileSisben.mimes' => 'La constancia del Sisbén debe ser PDF, JPG, PNG o JPEG.',
                'fileSisben.max' => 'La constancia del Sisbén no puede pesar más de 10MB.',
                'fileJAC.file' => 'El certificado de la Junta de Acción Comunal debe ser un archivo valido.',
                'fileJAC.mimes' => 'El certificado de la Junta de Acción Comunal debe ser PDF, JPG, PNG o JPEG.',
                'fileJAC.max' => 'El certificado de la Junta de Acción Comunal no puede pesar más de 10MB.',
                'terminos.required' => 'Debes aceptar los términos y condiciones.',
                'lat.numeric' => 'La latitud debe ser un valor numérico.',
                'lng.numeric' => 'La longitud debe ser un valor numérico.',
            ]);

            // 2️⃣ Verifica si puede crear solicitud
            if (!Solicitud::canCreateRequest($userId)) {
                $msg = 'Ya tienes una solicitud activa, procesando o pendiente.';
                return $request->ajax()
                    ? response()->json(['status' => 'info', 'message' => $msg], 200)
                    : back()->with('info', $msg);
            }

            // 3️⃣ Procesa y guarda archivos
            $filePaths = [];
            $fileFields = [
                'cedula' => 'cedula',
                'recibo' => 'recibo',
                'fileElectoral' => 'electoral',
                'fileSisben' => 'sisben',
                'fileRecibo' => 'recibo_opcional',
                'fileJAC' => 'jac',
            ];

            foreach ($fileFields as $inputName => $folder) {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $name = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                    $extension = $file->getClientOriginalExtension();
                    $filePaths[$inputName] = $file->storeAs($folder, "{$name}_" . now()->format('Ymd_His') . ".{$extension}", 'public');
                } else {
                    $filePaths[$inputName] = null;
                }
            }

            // 4️⃣ Crea la solicitud
            $solicitud = Solicitud::create([
                'user_id' => $userId,
                'numeroIdentificacion' => Auth::user()->numeroIdentificacion,
                'id_barrio' => $request->id_barrio,
                'direccion' => $request->direccion,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'cedula' => $filePaths['cedula'],
                'recibo' => $filePaths['recibo'],
                'electoral' => $filePaths['fileElectoral'],
                'sisben' => $filePaths['fileSisben'],
                'accion_comunal' => $filePaths['fileJAC'],
                'observaciones' => $request->observaciones,
                'terminos' => $request->has('terminos'),
                'tratamiento_datos' => $request->has('tratamiento_datos'),
                'estado_id' => 1,
            ]);

            try {
                Mail::to(Auth::user()->email)
                    ->send(new SolicitudCreadaNotification($solicitud->id, Auth::user()->name));
            } catch (\Throwable $e) {
                Log::error("Error al enviar correo de solicitud creada: " . $e->getMessage());
            }

            Log::info("Solicitud creada exitosamente por el usuario ID {$userId}.");

            return $request->ajax()
                ? response()->json([
                    'status' => 'success',
                    'message' => 'Tu solicitud fue enviada correctamente.',
                    'solicitud' => $solicitud
                ])
                : redirect()->route('versolicitudesresidencia')->with('success', 'Solicitud creada exitosamente.');

        } catch (ValidationException $e) {
            // ⚠️ Captura validaciones (422)
            Log::warning("Error de validación para usuario ID {$userId}: " . json_encode($e->errors()));

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Por favor corrige los errores en el formulario.',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;

        } catch (\Throwable $e) {
            Log::error("Error al crear solicitud: " . $e->getMessage());
            return $request->ajax()
                ? response()->json([
                    'status' => 'error',
                    'message' => 'Ocurrió un error al procesar la solicitud. Intenta nuevamente.'
                ], 500)
                : back()->with('error', 'Ocurrió un error al procesar la solicitud.');
        }
    }

     /**
     * Obtiene las solicitudes del usuario autenticado (AJAX)
     */
    public function getSolicitudes(Request $request)
    {
        try {
            $userId = auth()->id();
            $solicitudes = Solicitud::with(['user', 'barrio', 'estado', 'validaciones'])
                ->where('user_id', $userId)
                ->orderBy('id', 'desc')
                ->get();

            // Formatear datos para la vista
            $solicitudesFormateadas = $solicitudes->map(function ($solicitud) {
                $validacion = $solicitud->validaciones->where('id_solicitud', $solicitud->id)->first();
                $anulacion = Anulacion::where('solicitud_id', $solicitud->id)->first();

                return [
                    'id' => $solicitud->id,
                    'numeroIdentificacion' => $solicitud->numeroIdentificacion,
                    'direccion' => $solicitud->direccion,
                    'barrio' => strtolower($solicitud->barrio->zona) . ' ' .
                               ucfirst($solicitud->barrio->nombreBarrio) . ' - ' .
                               $solicitud->barrio->tipoUnidad . ' ' .
                               $solicitud->barrio->codigoNumero,
                    'created_at' => $solicitud->created_at->format('Y-m-d H:i'),
                    'estado' => $solicitud->estado->nombreEstado,
                    'estado_clase' => $this->getEstadoClase($solicitud->estado->nombreEstado),
                    'validacion_id' => $validacion?->id,
                    'validacion_visible' => $validacion?->visible ?? 0,
                    'anulacion_visible' => $anulacion?->visible ?? 0,
                    'tiene_anulacion' => $anulacion ? true : false,
                ];
            });

            return response()->json([
                'success' => true,
                'solicitudes' => $solicitudesFormateadas,
                'usuario' => auth()->user()->name
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar las solicitudes: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtiene los datos del usuario actual (AJAX)
     */
    public function getDatosUsuario(Request $request)
    {
        try {
            $user = User::with(['tipoSolicitante', 'tipoDocumento', 'nivelEstudio', 'genero', 'ocupacion', 'poblacion'])
                ->find(auth()->id());

            $datos = [
                'nombreCompleto' => trim($user->name . ' ' .
                                       ($user->nombre_2 ?? '') . ' ' .
                                       $user->apellido_1 . ' ' .
                                       ($user->apellido_2 ?? '')),
                'email' => $user->email,
                'telefonoContacto' => $user->telefonoContacto,
                'tipoSolicitante' => $user->tipoSolicitante->tipoSolicitante,
                'tipoDocumento' => $user->tipoDocumento->tipoDocumento,
                'numeroIdentificacion' => $user->numeroIdentificacion,
                'ciudadExpedicion' => $user->ciudadExpedicion,
                'fechaNacimiento' => $user->fechaNacimiento,
                'nivelEstudio' => $user->nivelEstudio->nivelEstudio,
                'genero' => $user->genero->nombreGenero,
                'ocupacion' => $user->ocupacion->nombreOcupacion,
                'poblacion' => $user->poblacion->nombrePoblacion,
            ];

            return response()->json([
                'success' => true,
                'datos' => $datos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar los datos del usuario'
            ], 500);
        }
    }

    /**
     * Obtiene las notas de validación (AJAX)
     */
    public function getNotas(Request $request, $id)
    {
        try {
            $validacion = Validacion::find($id);

            if (!$validacion) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron las notas.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'notas' => $validacion->notas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar las notas'
            ], 500);
        }
    }

    /**
     * Obtiene información de anulación (AJAX)
     */
    public function getAnulacion(Request $request, $id)
    {
        try {
            $anulacion = Anulacion::where('solicitud_id', $id)->first();

            if (!$anulacion) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró información de anulación.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'anulacion' => [
                    'descripcion' => $anulacion->descripcion,
                    'archivo' => $anulacion->archivo,
                    'archivo_url' => $anulacion->archivo ? asset('storage/' . $anulacion->archivo) : null,
                    'visible' => $anulacion->visible
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar la anulación'
            ], 500);
        }
    }

    /**
     * Genera y descarga el PDF del certificado
     */
    public function generarPDF($id)
    {
        try {
            $solicitud = Solicitud::findOrFail($id);

            if (!in_array((int) $solicitud->estado_id, [5, 6], true)) {
                abort(403, 'La solicitud no está emitida.');
            }

            $data = [
                'id' => $solicitud->id,
                'solicitante' => trim(
                    $solicitud->user->name . ' ' .
                    ($solicitud->user->nombre_2 ?? '') . ' ' .
                    $solicitud->user->apellido_1 . ' ' .
                    ($solicitud->user->apellido_2 ?? '')
                ),
                'tipoDocumento' => $solicitud->user->tipoDocumento->tipoDocumento,
                'cedula' => $solicitud->numeroIdentificacion,
                'direccion' => $solicitud->direccion,
                'cargo' => $solicitud->validador2->cargo,
                'validador' => trim(
                    $solicitud->validador2->name . ' ' .
                    ($solicitud->validador2->nombre_2 ?? '') . ' ' .
                    $solicitud->validador2->apellido_1 . ' ' .
                    ($solicitud->validador2->apellido_2 ?? '')
                ),
                'codigo_validador1' => $solicitud->actualizador->codigo,
                'firma' => $solicitud->validador2->firma,
                'ciudad_expedicion' => $solicitud->user->ciudadExpedicion,
                'barrio_vereda' => $solicitud->barrio->nombreBarrio,
                'tipo_unidad' => $solicitud->barrio->tipoUnidad,
                'codigo_numero' => $solicitud->barrio->codigoNumero,
                'zona' => $solicitud->barrio->zona,
                'estado' => $solicitud->estado->nombreEstado,
                'numero_certificado' => $solicitud->numeroIdentificacion,
                'fecha_emision' => $solicitud->fecha_emision
                    ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                    : 'N/A',
                'vigencia_inicio' => $solicitud->fecha_emision
                    ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                    : 'N/A',
                'vigencia_fin' => $solicitud->VigenciaFormateada,
                'verificacion_url' => env('APP_URL') . '/consulta-tramite',
                'qr' => public_path('storage/' . $solicitud->validaciones->first()->qr_url),
            ];

            $pdf = Pdf::loadView('certificados.certificado', $data);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $solicitud->id . '_' . $solicitud->numeroIdentificacion . '_certificadoResidencia.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    /**
     * Retorna la clase CSS según el estado
     */
    private function getEstadoClase($estado)
    {
        $clases = [
            'Pendiente' => 'warning',
            'Procesando' => 'success',
            'No completado' => 'danger',
            'En proceso' => 'info',
            'Emitido' => 'success',
            'Por vencer' => 'warning',
            'Anulado' => 'danger'
        ];

        return $clases[$estado] ?? 'secondary';
    }
}
