<?php

namespace App\Livewire;

use App\Models\Estado;
use Livewire\Component;
use App\Models\Solicitud;

class ValidarQr extends Component
{
    public $id;
    public $numeroIdentificacion;
    public $mensaje;
    public $solicitud;

    public function mount($id, $numeroIdentificacion)
    {
        // Buscar la solicitud con el ID y número de identificación proporcionados
        $this->solicitud = Solicitud::where('id', $id)
            ->where('numeroIdentificacion', $numeroIdentificacion)
            ->first();

        if (!$this->solicitud) {
            $this->mensaje = 'El documento no es válido. No se encontró una solicitud asociada.';
        } else {
            // Verificar el estado del documento
            switch ($this->solicitud->estado->nombreEstado ?? '') {
                case 'Emitido':
                    $this->mensaje = 'El certificado es válido y está vigente. A continuación, se muestran los detalles.';
                    break;
                case 'Vencido':
                    $this->mensaje = 'El certificado esta vencido. Por favor, actualícelo. No es válido.';
                    break;
                case 'no completado':
                    $this->mensaje = 'El certificado no fue completado. Consulte con la entidad correspondiente. No es válido.';
                    break;
                case 'En revision':
                    $this->mensaje = 'El certificado se encuentra en proceso de revisión. No es válido.';
                    break;
                case 'Procesando':
                    $this->mensaje = 'El certificado se encuentra en proceso de emisión. No es válido.';
                    break;
                case 'Por vencer':
                    $this->mensaje = 'El certificado es válido y está vigente. Pero está próximo a vencer. Por favor, actualícelo.';
                    break;
                case 'Pendiente':
                    $this->mensaje = 'El certificado se encuentra en proceso de validación. No es válido.';
                    break;
                default:
                    $this->mensaje = 'El certificado se encuentra en estado desconocido o no válido.';
                    break;
            }
        }

    }

    public function render()
    {
        return view('livewire.validar-qr', [
            'solicitud' => $this->solicitud,
            'mensaje' => $this->mensaje,
            'estados' => Estado::where('id', '!=', 4)->get()
        ])->layout('layouts.guest');
    }
}
