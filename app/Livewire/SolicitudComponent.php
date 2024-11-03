<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Barrio;
use App\Models\Estado;
use Livewire\Component;
use App\Models\Direccion;
use App\Models\Solicitud;
use Livewire\WithFileUploads; // Para manejar la subida de archivos

class SolicitudComponent extends Component
{
    use WithFileUploads;

    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }
    public $nombreCompleto, $email, $telefonoContacto, $id_tipoSolicitante, $id_tipoDocumento,
    $numeroIdentificacion, $ciudadExpedicion, $fechaNacimiento, $solicitud_id,
    $fechaSolicitud, $id_nivelEstudio, $id_genero, $id_ocupacion, $id_poblacion,
    $numeroIdentificacion_id, $fechaActual, $barrio_id, $direccion_id, $ubicacion,
    $accion_comunal, $electoral, $sisben, $cedula, $estado_id, $showForm = false, $showValidar = false;




    protected $rules = [
        'estado_id' => 'required|exists:estados,id', // Validación para el estado
    ];

    protected $listeners = ['edit', 'delete', 'view', 'procesar'];

    public function view($Id)
    {

        $user = User::find($Id);
        // Concatenando los nombres
        $this->nombreCompleto = $user->name . ' ' . $user->nombre_2 . ' ' . $user->apellido_1 . ' ' . $user->apellido_2;
        $this->email = $user->email;
        $this->telefonoContacto = $user->telefonoContacto;
        $this->id_tipoSolicitante = $user->tipoSolicitante->tipoSolicitante;
        $this->id_tipoDocumento = $user->tipoDocumento->tipoDocumento;
        $this->numeroIdentificacion = $user->numeroIdentificacion;
        $this->ciudadExpedicion = $user->ciudadExpedicion;
        $this->fechaNacimiento = $user->fechaNacimiento;
        $this->id_nivelEstudio = $user->nivelEstudio->nivelEstudio;
        $this->id_genero = $user->genero->nombreGenero;
        $this->id_ocupacion = $user->ocupacion->nombreOcupacion;
        $this->id_poblacion = $user->poblacion->nombrePoblacion;
        $this->showForm = true;
    }

    // enviar datos a modal procesar para que el validador 1 cambie el estado
    public function procesar($Id)
    {
        $solicitud = Solicitud::find($Id);
        $this->solicitud_id = $solicitud->id;
        $this->showValidar = true;
    }


    public function save()
    {
        $this->validate();

        if ($this->solicitud_id) {
            $solicitud = Solicitud::find($this->solicitud_id);


            $solicitud->update([
                'estado_id' => $this->estado_id,
                'actualizado_por' => auth()->id() 
            ]);
        }

        $this->showValidar = false;
        $this->dispatch('Updated');
    }



    public function edit($Id)
    {
        $solicitud = Solicitud::find($Id);

        if ($solicitud) {
            $this->solicitud_id = $solicitud->id;
            $this->fechaSolicitud = $solicitud->fechaSolicitud;
            $this->numeroIdentificacion_id = $solicitud->numeroIdentificacion_id;
            $this->fechaActual = $solicitud->fechaActual;
            $this->barrio_id = $solicitud->barrio_id;
            $this->direccion_id = $solicitud->direccion_id;
            $this->ubicacion = $solicitud->ubicacion;
            $this->estado_id = $solicitud->estado;
            $this->showForm = true;
        }
    }



    public function delete($Id)
    {
        $solicitud = Solicitud::find($Id);
        $solicitud->delete();
        $this->dispatch('Updated');
    }




    //datos del model

    public function render()
    {
        // estados, solo pasar los estados con id 1, 2 y 3
        $estados = Estado::whereIn('id', [1, 2, 3])->get();

        return view('livewire.solicitud-component', [
            'solicitudes' => Solicitud::with('barrio', 'direccion'), // Paginación de 10 elementos
            'estados' => $estados,
        ]);
    }
}
