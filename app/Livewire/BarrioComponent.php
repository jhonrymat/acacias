<?php

namespace App\Livewire;

use App\Models\Barrio;
use Livewire\Component;

class BarrioComponent extends Component
{
    public $barrio_id;  // ID para evitar conflictos con Livewire
    public $nombreBarrio;
    public $tipoUnidad;
    public $codigoNumero;  // UPZ o UPR
    public $zona;  // numero
    public $showForm = false; // Control para mostrar/ocultar el formulario
   
    // Validación básica
    protected $rules = [
        'nombreBarrio' => 'required|string|max:255',
        'tipoUnidad' => 'required|string|max:255',
        'codigoNumero' => 'required|string|max:50',  // Puede ser UPZ o UPR
        'zona' => 'required|string|max:50',  // Tipo de área (Barrio, Vereda, etc.)
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->barrio_id) {
            // Si estamos editando un barrio existente
            $barrio = Barrio::find($this->barrio_id);
            if ($barrio) {
                $barrio->update([
                    'nombreBarrio' => $this->nombreBarrio,
                    'tipoUnidad' => $this->tipoUnidad,
                    'codigoNumero' => $this->codigoNumero,
                    'zona' => $this->zona
                ]);
            }
        } else {
            // Si no hay barrio_id, creamos un nuevo barrio
            Barrio::create([
                'nombreBarrio' => $this->nombreBarrio,
                'tipoUnidad' => $this->tipoUnidad,
                'codigoNumero' => $this->codigoNumero,
                'zona' => $this->zona,
            ]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->dispatch('Updated');
    }

    public function edit($Id)
    {
        $barrio = Barrio::find($Id);

        if ($barrio) {
            $this->barrio_id = $barrio->id;  // Mostrar el ID actual en el formulario
            $this->nombreBarrio = $barrio->nombreBarrio;  // Cargar el campo nombreBarrio
            $this->tipoUnidad = $barrio->tipoUnidad;
            $this->codigoNumero = $barrio->codigoNumero;
            $this->zona = $barrio->zona;
            $this->showForm = true;  // Mostrar el formulario al editar
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function delete($Id)
    {
        $barrio = Barrio::find($Id);
        if ($barrio) {
            $barrio->delete();
            $this->dispatch('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->barrio_id = null;
        $this->nombreBarrio = null;  // Limpiar los campos del formulario
        $this->tipoUnidad = null;
        $this->codigoNumero = null;
        $this->zona = null;
    }

    public function render()
    {
        return view('livewire.barrio-component');
    }
}
