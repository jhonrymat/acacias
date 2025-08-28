<?php

namespace App\Http\Controllers;

use App\Models\SolicitudAvecindamiento;
use App\Models\ValidacionAvecindamiento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Solicitud;
use Carbon\Carbon;

class PDFController extends Controller
{
    public function verPDF($Id)
    {
        $solicitud = Solicitud::findOrFail($Id);

        // Opción 2 (más limpia)
        if (!in_array((int) $solicitud->estado_id, [5, 6], true)) {
            return abort(403, 'La solicitud no está emitida.');
        }


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

        // Devolver el PDF en el navegador
        return $pdf->stream('certificado.pdf');
    }

    public function verPDFAvecindamiento($Id)
    {
        $solicitud = SolicitudAvecindamiento::findOrFail($Id);
        $validacion = ValidacionAvecindamiento::where('id_solicitud', $Id)->first();
        if (!$validacion) {
            session()->flash('error', 'No se encontró la validación de la solicitud.');
            return;
        }

        if (!in_array((int) $solicitud->estado_id, [5, 6], true)) {
            return abort(403, 'La solicitud no está emitida.');
        }

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

            'fecha_visita' => $validacion->created_at
                ? Carbon::parse($validacion->created_at)->translatedFormat('d \\de F \\de Y')
                : 'N/A',

            'vigencia_fin' => $solicitud->VigenciaFormateada,
            'verificacion_url' => env('APP_URL') . '/consulta-tramite',
            'qr' => public_path('storage/' . $solicitud->validaciones->first()->qr_url),
        ];

        // Generar el PDF
        $pdf = Pdf::loadView('certificados.certificadoAvecindamientoUsuario', $data);

        // Devolver el PDF en el navegador
        return $pdf->stream('certificado.pdf');
    }
}
