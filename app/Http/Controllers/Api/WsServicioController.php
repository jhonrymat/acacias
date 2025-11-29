<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Log;

class WsServicioController extends Controller
{
    /**
     * Servicio web para consultar certificado de residencia
     *
     * @param string $tipoDocumento Tipo de documento (CC, TI, CE, etc.)
     * @param string $numeroIdentificacion Número de identificación
     * @return JsonResponse
     */
    public function consultarCertificado(string $tipoDocumento, string $numeroIdentificacion): JsonResponse
    {
        try {
            // Buscar usuario por número de identificación
            $usuario = User::where('numeroIdentificacion', $numeroIdentificacion)->first();

            // Si no existe el usuario, retornar respuesta vacía
            if (!$usuario) {
                Log::info("WsServicioController: Usuario no encontrado para tipoDocumento={$tipoDocumento}, numeroIdentificacion={$numeroIdentificacion}");
                return $this->respuestaVacia();
            }

            // Extraer sigla del tipo de documento (sin columna sigla en BD)
            $siglaBD = $this->extraerSigla($usuario->tipoDocumento->tipoDocumento ?? '');

            // Verificar que el tipo de documento coincida
            if (strtoupper($siglaBD) !== strtoupper($tipoDocumento)) {
                Log::info("WsServicioController: Tipo de documento no coincide para numeroIdentificacion={$numeroIdentificacion}. Esperado={$siglaBD}, Recibido={$tipoDocumento}");
                return $this->respuestaVacia();
            }

            // Buscar la solicitud más reciente con estados válidos (5=Emitido, 6=Por vencer)
            $solicitud = Solicitud::where('numeroIdentificacion', $numeroIdentificacion)
                ->whereIn('estado_id', [5, 6])
                ->orderBy('fecha_emision', 'desc')
                ->first();

            // Si no hay solicitud válida, retornar respuesta vacía
            if (!$solicitud) {
                Log::info("WsServicioController: Solicitud no encontrada o no válida para numeroIdentificacion={$numeroIdentificacion}");
                return $this->respuestaVacia();
            }

            // Generar PDF (con cache automático)
            $pdfBase64 = $this->generarPdfBase64($solicitud);

            // Construir respuesta exitosa
            return response()->json([
                'datoconsultado' => [
                    [
                        'campoDato' => 'Tipo de Documento',
                        'valorDato' => strtoupper($tipoDocumento)
                    ],
                    [
                        'campoDato' => 'Número de Documento',
                        'valorDato' => $numeroIdentificacion
                    ],
                    [
                        'campoDato' => 'Primer Nombre',
                        'valorDato' => $usuario->name ?? ''
                    ],
                    [
                        'campoDato' => 'Segundo Nombre',
                        'valorDato' => $usuario->nombre_2 ?? ''
                    ],
                    [
                        'campoDato' => 'Primer Apellido',
                        'valorDato' => $usuario->apellido_1 ?? ''
                    ],
                    [
                        'campoDato' => 'Segundo Apellido',
                        'valorDato' => $usuario->apellido_2 ?? ''
                    ],
                    [
                        'campoDato' => 'Dirección Correo Electrónico',
                        'valorDato' => $usuario->email ?? ''
                    ],
                    [
                        'campoDato' => 'Número Teléfono',
                        'valorDato' => $usuario->telefonoContacto ?? ''
                    ],
                    [
                        'campoDato' => 'Estado Solicitud',
                        'valorDato' => $solicitud->estado->nombreEstado ?? 'Pendiente'
                    ],
                    [
                        'nombreArchivo' => 'certificado-residencia.pdf',
                        'valorDato' => $pdfBase64,
                        'descripcionArchivo' => 'certificado de Residencia',
                        'tipoArchivo' => 'PDF',
                        'campoDato' => 'archivoBase64'
                    ]
                ],
                'urlDescarga' => ''
            ]);

        } catch (\Exception $e) {
            // En caso de error, retornar respuesta vacía
            return $this->respuestaVacia();
        }
    }

    /**
     * Generar PDF y convertirlo a Base64 (CON CACHE - OPTIMIZADO)
     *
     * 🚀 La primera vez tarda ~300ms, las siguientes ~10ms
     *
     * @param Solicitud $solicitud
     * @return string
     */
    private function generarPdfBase64(Solicitud $solicitud): string
    {
        // Cache por 1 hora (ajusta según tus necesidades)
        // La clave incluye updated_at para invalidar automáticamente si se actualiza
        $cacheKey = "certificado_pdf_{$solicitud->id}_{$solicitud->updated_at->timestamp}";

        return Cache::remember($cacheKey, 3600, function () use ($solicitud) {
            // Datos dinámicos para la plantilla
            $data = [
                'id' => $solicitud->id,
                'solicitante' => trim(
                    $solicitud->user->name
                    . ' '
                    . ($solicitud->user->nombre_2 ?? '')
                    . ' '
                    . $solicitud->user->apellido_1
                    . ' '
                    . ($solicitud->user->apellido_2 ?? '')
                ),
                'tipoDocumento' => $solicitud->user->tipoDocumento->tipoDocumento,
                'cedula' => $solicitud->numeroIdentificacion,
                'direccion' => $solicitud->direccion,
                'cargo' => $solicitud->validador2->cargo,
                'validador' => trim(
                    $solicitud->validador2->name
                    . ' '
                    . ($solicitud->validador2->nombre_2 ?? '')
                    . ' '
                    . $solicitud->validador2->apellido_1
                    . ' '
                    . ($solicitud->validador2->apellido_2 ?? '')
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

            // Generar el PDF
            $pdf = Pdf::loadView('certificados.certificado', $data);

            // Convertir PDF a Base64
            return base64_encode($pdf->output());
        });
    }

    /**
     * Respuesta vacía cuando no hay datos o error
     *
     * @return JsonResponse
     */
    private function respuestaVacia(): JsonResponse
    {
        return response()->json([
            'datoConsultado' => '',
            'urlDescarga' => ''
        ]);
    }

    /**
     * Extraer sigla del nombre del tipo de documento
     *
     * @param string $tipoDocumento
     * @return string
     */
    private function extraerSigla(string $tipoDocumento): string
    {
        $mapeo = [
            'Registro civil' => 'RC',
            'Tarjeta de identidad' => 'TI',
            'Cédula de ciudadanía' => 'CC',
            'Cédula extranjera' => 'CE',
            'NIT' => 'NIT',
            'Permiso por protección temporal' => 'PPT',
            'Permiso especial de permanencia' => 'PEP',
            'Salvoconducto para refugiados' => 'SC',
        ];

        return $mapeo[$tipoDocumento] ?? '';
    }
}
