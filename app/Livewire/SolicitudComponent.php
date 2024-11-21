<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Barrio;
use App\Models\Estado;
use Livewire\Component;
use App\Models\Direccion;
use App\Models\Solicitud;
use App\Models\Validacion;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

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
    $accion_comunal, $electoral, $sisben, $cedula, $estado_id, $estado_id2, $JAComunal, $detalles, $visible = false, $showForm = false, $showAdditional = false, $showValidar = false,
    $validacion1, $validacion2, $notas, $nombre, $validador, $Id;




    protected $rules = [
        'estado_id' => 'required|string',
        'estado_id2' => 'required|exists:estados,id', // Validación para el estado
        'JAComunal' => 'nullable|file|mimes:pdf,png,jpg|max:10240', // Máximo 10 MB
        'detalles' => 'required|string',
        'visible' => 'nullable|boolean',
    ];

    //mostar validaciones en español
    protected $messages = [
        'estado_id.required' => 'El campo "Primer filtro" es obligatorio.',
        'estado_id2.required' => 'El campo "Segundo filtro" es obligatorio.',
        'estado_id2.exists' => 'El estado seleccionado no es válido.',
        'JAComunal.mimes' => 'El archivo debe ser de tipo: PDF, PNG o JPG.',
        'JAComunal.max' => 'El archivo no debe superar los 10 MB.',
        'detalles.required' => 'El campo "Observaciones" es obligatorio.',
        'visible.boolean' => 'El campo "Habilitar visualización" debe ser verdadero o falso.',
    ];



    protected $listeners = ['edit', 'delete', 'view', 'procesar', 'see', 'validar', 'rechazar'];

    public function view($Id)
    {
        // obtener el user_id del id de la solicitud
        $solicitud = Solicitud::find($Id);

        $user = User::find($solicitud->user_id);
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

    public function see($Id)
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


        $this->showAdditional = true;
    }

    public function validar($Id)
    {
        $this->Id = $Id;
        $this->dispatch('alert',
            icon : 'info',
            title : '¿Estás seguro?',
            text : 'Vas a confirmar la solicitud'
        );
    }

    public function validarsweet(){
        Solicitud::find($this->Id)->update([
            'estado_id' => 5,
            'Validador2_id' => Auth::id()
        ]);

        $this->dispatch('Updated');

        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Solicitud aprobada con exito.');

    }


    public function rechazar($Id)
    {
        $this->Id = $Id;
        $this->dispatch('2alert',
            icon : 'info',
            title : '¿Estás seguro?',
            text : 'Vas a rechazar esta solicitud'
        );
    }

    public function rechazarsweet(){
        Solicitud::find($this->Id)->update([
            'estado_id' => 3,
            'Validador2_id' => Auth::id()
        ]);

        $this->dispatch('Updated');

        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Solicitud rechazada con exito.');

    }

    // enviar datos a modal procesar para que el validador 1 cambie el estado
    public function procesar($Id)
    {
        $solicitud = Solicitud::find($Id);
        // obtener el usuario de esta solicitud
        $user = User::find($solicitud->user_id);

        // Obtener el ID de los estados "Pendiente" y "En revisión"
        $pendienteId = 1; // ID de "Pendiente" (ajústalo según el estado real)
        $enRevisionId = 4;

        // Verificar si la solicitud ya ha cambiado de estado a algo diferente a "Pendiente" o "En revisión"
        if ($solicitud->estado_id != $pendienteId && $solicitud->estado_id != $enRevisionId) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud ya procesada.', text: 'Esta solicitud ya fue aprobada, rechazada o procesada por otro validador.');
            $this->dispatch('Updated');
            return;
        }

        // Verificar si la solicitud está en revisión por otro validador
        if ($solicitud->estado_id == $enRevisionId && $solicitud->actualizado_por !== auth()->id()) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud en revisión.', text: 'No puedes validar la solicitud actual, ya se encuentra en revisión por otro validador.');
            $this->dispatch('Updated');
            return;
        }

        // Si la solicitud está en revisión por el mismo validador, permitir el acceso sin actualizar el estado
        if ($solicitud->estado_id == $enRevisionId && $solicitud->actualizado_por === auth()->id()) {
            $this->solicitud_id = $solicitud->id;
            // Pasar el numero de identificacion del usuario
            $this->numeroIdentificacion_id = $user->numeroIdentificacion;
            $this->showValidar = true;
            $this->dispatch('Updated');
            return;
        }

        // Bloquear la solicitud al validador actual si no está en revisión o si no está bloqueada aún
        $solicitud->update([
            'estado_id' => $enRevisionId,
            'actualizado_por' => auth()->id() // Bloquea la solicitud para el usuario actual
        ]);

        $this->solicitud_id = $solicitud->id;
        // Pasar el numero de identificacion del usuario
        $this->numeroIdentificacion_id = $user->numeroIdentificacion;
        $this->showValidar = true;
    }

    public function confirmLiberar()
    {
        // Emitir un evento a JavaScript para solicitar confirmación
        $this->dispatch(
            'confirm',
            title: '¿Estás seguro?',
            text: '¿En serio quieres liberar la solicitud actual? Tu progreso se perderá.',
            confirmButtonText: 'Sí, liberar',
            cancelButtonText: 'Cancelar'
        );
    }

    public function liberar()
    {
        if ($this->solicitud_id) {
            $solicitud = Solicitud::find($this->solicitud_id);

            // Cambiar el estado a pendiente y eliminar el bloqueo del validador
            $solicitud->update([
                'estado_id' => 1, // Estado "Pendiente"
                'actualizado_por' => null
            ]);

            $this->solicitud_id = null;
            $this->showValidar = false;
            $this->dispatch('Updated');
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud liberada', text: 'Has liberado la solicitud. Ahora otros validadores pueden revisarla.');
        }
    }



    public function save()
    {
        $this->validate();

        if ($this->solicitud_id) {
            $solicitud = Solicitud::find($this->solicitud_id);

            $solicitud->update(['estado_id' => $this->estado_id2]);

            try {
                $solicitud->validaciones()->create([
                    'validacion1' => $this->estado_id,
                    'validacion2' => $this->estado_id2,
                    'JAComunal' => $this->JAComunal ? $this->JAComunal->store('uploads', 'public') : null,
                    'notas' => $this->detalles,
                    'visible' => $this->visible,
                ]);
                $this->dispatch('sweet-alert-good', icon: 'success', title: 'Validación creada con éxito', text: 'La validación se ha guardado correctamente.');

            } catch (\Exception $e) {
                $this->dispatch('sweet-alert-good', icon: 'info', title: 'Error', text: 'Error al guardar la validación.');

            }
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
        $estados = Estado::whereIn('id', [2, 3])->get();

        return view('livewire.solicitud-component', [
            'solicitudes' => Solicitud::with('barrio', 'direccion'), // Paginación de 10 elementos
            'estados' => $estados,
        ]);
    }
}
