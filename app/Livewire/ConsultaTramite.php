<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Solicitud;
use App\Models\SolicitudAvecindamiento;
use App\Models\Estado;

class ConsultaTramite extends Component
{
    public $numeroIdentificacion;
    public $numeroSolicitud;
    public $resultados = null;
    public $tipoConsulta;
    public $datoConsulta;
    public $tipoSolicitud = '';



    protected $rules = [
        'tipoSolicitud' => 'required|in:residencia,avecindamiento',
        'tipoConsulta' => 'required|in:numeroIdentificacion,numeroSolicitud',
        'datoConsulta' => 'required|numeric',
    ];

    // personalizar los mensajes de error
    protected $messages = [
        'tipoSolicitud.required' => 'El campo tipo de solicitud es obligatorio.',
        'tipoSolicitud.in' => 'El campo tipo de solicitud no es válido.',
        'tipoConsulta.required' => 'El campo tipo de consulta es obligatorio.',
        'tipoConsulta.in' => 'El campo tipo de consulta no es válido.',
        'datoConsulta.required' => 'El campo dato de consulta es obligatorio.',
        'datoConsulta.numeric' => 'El campo dato de consulta debe ser numérico.',
    ];

    public function buscar()
    {
        $this->validate();

        if ($this->tipoSolicitud === 'residencia') {
            $query = Solicitud::query();
        } elseif ($this->tipoSolicitud === 'avecindamiento') {
            $query = SolicitudAvecindamiento::query();
        } else {
            session()->flash('error', 'Tipo de solicitud no válido.');
            return;
        }

        if ($this->tipoConsulta === 'numeroIdentificacion') {
            $query->where('numeroIdentificacion', $this->datoConsulta);
        } elseif ($this->tipoConsulta === 'numeroSolicitud') {
            $query->where('id', $this->datoConsulta);
        }

        $this->resultados = $query->with('estado')->latest()->first();

        if (!$this->resultados) {
            session()->flash('error', 'No se encontró ningún trámite con los datos ingresados.');
        }
    }


    public function render()
    {
        return view('livewire.consulta-tramite', [
            'estados' => Estado::where('id', '!=', 4)->get()
        ])->layout('layouts.guest');
    }
}
