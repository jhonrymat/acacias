<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Estado;
use Livewire\Component;
use App\Models\SolicitudAvecindamiento;
use Illuminate\Support\Facades\Storage;
use App\Models\ValidacionAvecindamiento;

class HistorialAvecindamientoComponent extends Component
{
    public $validacion1, $validacion2, $notas, $visible = false, $showForm = false, $cedula, $nombre, $validador, $nameAll;
    public $coordenadasFrente = [];
    public $coordenadasMatricula = [];
    public $solicitud_avecindamiento;
    protected $listeners = ['view'];

    public $evidencia_residencia;
    public $tiempo_residencia_anios;
    public $tiempo_residencia_meses;

    public function view($Id)
    {
        // Obtener la solicitud por su ID
        $solicitud = SolicitudAvecindamiento::with('imagenes', 'user', 'validaciones')->find($Id);
        if (!$solicitud) {
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'La solicitud no existe.');
            return;
        }

        // Obtener la primera validación relacionada con la solicitud (si existe)
        $validacion = $solicitud->validaciones()->first();
        if (!$validacion) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Sin validaciones.', text: 'No se encontraron validaciones para esta solicitud.');
            return;
        }
        // obtener el nombre del estado de $validacion->validacion2;
        $estado = Estado::find($validacion->validacion2);
        //obtener el nombre del validador $solicitud->actualizado_por
        $validador = User::find($solicitud->actualizado_por);

        $this->coordenadasFrente = $solicitud->imagenes->where('tipo', 'frente')->map(function ($img) {
            return [
                'lat' => $img->lat,
                'lng' => $img->lng,
                'url' => Storage::url($img->ruta),
            ];
        })->values()->toArray();

        $this->coordenadasMatricula = $solicitud->imagenes->where('tipo', 'matricula')->map(function ($img) {
            return [
                'lat' => $img->lat,
                'lng' => $img->lng,
                'url' => Storage::url($img->ruta),
            ];
        })->values()->toArray();

        // Asignar solicitud completa como propiedad para el modal
        $this->solicitud_avecindamiento = $solicitud;

        // Asignar valores de la validación a las propiedades
        $this->validacion1 = $validacion->validacion1;
        $this->validacion2 = $estado->nombreEstado;
        $this->notas = $validacion->notas;
        $this->visible = $validacion->visible;

        $this->evidencia_residencia = $validacion->evidencia_residencia;

        $tiempo = json_decode($validacion->tiempo_residencia, true);
        $this->tiempo_residencia_anios = $tiempo['anios'] ?? null;
        $this->tiempo_residencia_meses = $tiempo['meses'] ?? null;

        $this->nombre = $solicitud->user->name;
        $this->cedula = $solicitud->numeroIdentificacion;
        $this->validador = $validador ? ($validador->name . ' | ' . $validador->codigo) : 'No asignado';
        $this->nameAll = $solicitud->NombreCompleto;

        $this->showForm = true;
    }



    public function render()
    {
        return view('livewire.historial-avecindamiento-component');
    }
}
