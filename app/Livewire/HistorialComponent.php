<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Estado;
use Livewire\Component;
use App\Models\Solicitud;
use App\Models\Validacion;

class HistorialComponent extends Component
{

    public $validacion1, $validacion2, $JAComunal, $notas, $visible = false, $showForm = false, $cedula, $nombre, $validador;

    protected $listeners = ['view'];
    public function view($Id)
    {
        // Obtener la solicitud por su ID
        $solicitud = Solicitud::find($Id);

        // Obtener la primera validación relacionada con la solicitud (si existe)
        $validacion = $solicitud->validaciones()->first();
        // obtener el nombre del estado de $validacion->validacion2;
        $estado = Estado::find($validacion->validacion2);
        //obtener el nombre del validador $solicitud->actualizado_por
        $validador = User::find($solicitud->actualizado_por);


        if (!$validacion) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Sin validaciones.', text: 'No se encontraron validaciones para esta solicitud.');
        }

        // Asignar valores de la validación a las propiedades
        $this->validacion1 = $validacion->validacion1;
        $this->validacion2 = $estado->nombreEstado;
        $this->JAComunal = $validacion->JAComunal;
        $this->notas = $validacion->notas;
        $this->visible = $validacion->visible;
        $this->cedula = $solicitud->numeroIdentificacion;
        $this->nombre = $solicitud->user->name;
        $this->validador = $validador->name;

        $this->showForm = true;
    }


    public function render()
    {
        return view('livewire.historial-component');
    }
}
