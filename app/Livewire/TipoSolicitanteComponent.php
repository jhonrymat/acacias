<?php
namespace App\Livewire;

use App\Models\Tsolicitante;
use Livewire\Component;

class TipoSolicitanteComponent extends Component
{
    public $solicitante_id;  // Cambiar $id a $solicitante_id para evitar conflictos
    public $tipoSolicitante;
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica
    protected $rules = [
        'tipoSolicitante' => 'required|string|max:255',
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->solicitante_id) {
            // Si estamos editando un tipo de solicitante existente
            $solicitante = Tsolicitante::find($this->solicitante_id);
            if ($solicitante) {
                $solicitante->update([
                    'tipoSolicitante' => $this->tipoSolicitante
                ]);
            }
        } else {
            // Si no hay solicitante_id, creamos un nuevo tipo de solicitante
            Tsolicitante::create(['tipoSolicitante' => $this->tipoSolicitante]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->dispatch('Updated');
    }

    public function edit($Id)
    {
        $solicitante = Tsolicitante::find($Id);

        if ($solicitante) {
            $this->solicitante_id = $solicitante->id;    // Mostrar el ID actual en el formulario
            $this->tipoSolicitante = $solicitante->tipoSolicitante;  // Cargar el campo tipoSolicitante
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
        $solicitante = Tsolicitante::find($Id);
        if ($solicitante) {
            $solicitante->delete();
            $this->dispatch('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->solicitante_id = null;
        $this->tipoSolicitante = null;  // Limpiar los campos del formulario
    }

    public function render()
    {
        return view('livewire.tsolicitante-component');
    }
}
