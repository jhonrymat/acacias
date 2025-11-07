<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Mail\SolicitudCreadaNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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
}