<?php

namespace App\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Solicitud;

class CertificadoComponent extends Component
{
    public $solicitudId;

    public function generarPDF()
    {
        $solicitud = Solicitud::findOrFail($this->solicitudId);

        // Validar el estado de la solicitud
        if ($solicitud->estado_id !== 5) {
            session()->flash('error', 'La solicitud no está emitida.');
            return;
        }

        // Datos dinámicos para la plantilla
        $data = [
            'solicitante' => $solicitud->nombre,
            'cedula' => $solicitud->cedula,
            'direccion' => $solicitud->direccion,
            'vigencia_inicio' => now()->format('d/m/Y'),
            'vigencia_fin' => now()->addYear()->format('d/m/Y'),
            'verificacion_url' => 'https://acacias.gov.co/gfiles/consultaTramite/',
        ];

        // Generar el PDF
        $pdf = PDF::loadView('certificados.certificado', $data);

        // Descargar el archivo
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'certificado_residencia.pdf');
    }

    public function render()
    {
        return view('livewire.certificado-component');
    }
}
