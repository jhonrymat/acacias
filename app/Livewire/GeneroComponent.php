<?php
namespace App\Livewire;

use App\Models\Genero;
use Livewire\Component;

class GeneroComponent extends Component
{
    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }
    public $genero_id;  // Cambiar $id a $genero_id para evitar conflictos
    public $nombreGenero;
    public $showForm = false; // Control para mostrar/ocultar el formulario

    // Validación básica
    protected $rules = [
        'nombreGenero' => 'required|string|max:255',
    ];

    protected $listeners = ['edit', 'delete'];

    public function save()
    {
        // Validamos los datos
        $this->validate();

        if ($this->genero_id) {
            // Si estamos editando un género existente
            $genero = Genero::find($this->genero_id);
            if ($genero) {
                $genero->update([
                    'nombreGenero' => $this->nombreGenero
                ]);
            }
        } else {
            // Si no hay genero_id, creamos un nuevo género
            Genero::create(['nombreGenero' => $this->nombreGenero]);
        }

        // Resetear el formulario y ocultarlo después de guardar
        $this->resetFields();
        $this->showForm = false;

        // Emitir el evento para refrescar la tabla
        $this->dispatch('Updated');
    }

    public function edit($Id)
    {
        $genero = Genero::find($Id);

        if ($genero) {
            $this->genero_id = $genero->id;    // Mostrar el ID actual en el formulario
            $this->nombreGenero = $genero->nombreGenero;  // Cargar el campo nombreGenero
            $this->showForm = true;            // Mostrar el formulario al editar
        }
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true; // Mostrar el formulario al crear
    }

    public function delete($Id)
    {
        $genero = Genero::find($Id);
        if ($genero) {
            $genero->delete();
            $this->dispatch('Updated'); // Refrescar la tabla después de eliminar
        }
    }

    public function resetFields()
    {
        $this->genero_id = null;
        $this->nombreGenero = null;  // Limpiar los campos del formulario
    }

    public function render()
    {
        return view('livewire.genero-component');
    }
}
