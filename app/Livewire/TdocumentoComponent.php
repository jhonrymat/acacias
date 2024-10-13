<?php
namespace App\Livewire;

use App\Models\Tdocumento;
use Livewire\Component;

class TdocumentoComponent extends Component
{
    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }
    public $documento_id;  // Cambiar $id a $documento_id
    public $tipoDocumento;
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica
    protected $rules = [
        'tipoDocumento' => 'required|string|max:255',
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->documento_id) {
            // Si estamos editando un documento existente
            $documento = Tdocumento::find($this->documento_id);
            if ($documento) {
                $documento->update([
                    'tipoDocumento' => $this->tipoDocumento
                ]);
            }
        } else {
            // Si no hay documento_id, creamos un nuevo documento
            Tdocumento::create(['tipoDocumento' => $this->tipoDocumento]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->dispatch('Updated');
    }

    #[On('edit')]
    public function edit($Id)
    {
        $documento = Tdocumento::find($Id);

        if ($documento) {
            $this->documento_id = $documento->id;
            $this->tipoDocumento = $documento->tipoDocumento;
            $this->showForm = true;
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    #[On('delete')]
    public function delete($Id)
    {
        $documento = Tdocumento::find($Id);
        if ($documento) {
            $documento->delete();
            $this->dispatch('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->documento_id = null;
        $this->tipoDocumento = null;  // Limpiar los campos del formulario
    }

    public function render()
    {
        return view('livewire.tdocumento-component');
    }
}
