<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ocupacion;

class OcupacionComponent extends Component
{

    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }

    public $id_ocupacion;  // Cambiar $id a $ocupacion_id para evitar conflictos
    public $nombreOcupacion;
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica
    protected $rules = [
        'nombreOcupacion' => 'required|string|max:255',
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->id_ocupacion) {
            // Si estamos editando ocupacion existente
            $ocupacion = Ocupacion::find($this->id_ocupacion);
            if ($ocupacion) {
                $ocupacion->update([
                    'nombreOcupacion' => $this->nombreOcupacion
                ]);
            }
        } else {
            // Si no hay ocupacion_id, creamos uno nevo
            Ocupacion::create(['nombreOcupacion' => $this->nombreOcupacion]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->dispatch('Updated');
    }

    public function edit($Id)
    {
        $ocupacion = Ocupacion::find($Id);

        if ($ocupacion) {
            $this->id_ocupacion = $ocupacion->id;    // Mostrar el ID actual en el formulario
            $this->nombreOcupacion = $ocupacion->nombreOcupacion;  // Cargar el campo nivelEstudio
            $this->showForm = true;              // Mostrar el formulario al editar
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function delete($Id)
    {
        $ocupacion = Ocupacion::find($Id);
        if ($ocupacion) {
            $ocupacion->delete();
            $this->dispatch('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->id_ocupacion = null;
        $this->nombreOcupacion = null;  // Limpiar los campos del formulario
    }

    public function render()
    {
        return view('livewire.ocupacion-component');
    }
}
