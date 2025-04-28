<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Barrio;
use App\Models\Estado;
use App\Models\Imagen;
use Livewire\Component;
use Milon\Barcode\DNS2D;
use App\Models\Direccion;
use Livewire\WithFileUploads;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\SolicitudAvecindamiento;
use Illuminate\Support\Facades\Storage;
use App\Models\ValidacionAvecindamiento;


class SolicitudAvecindamientoComponent extends Component
{

    use WithFileUploads;

    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }

        $this->AllStatus = Estado::all()->toArray(); // Obtén todos los estados como un array
    }
    public $nombreCompleto, $email, $telefonoContacto, $id_tipoSolicitante, $id_tipoDocumento,
    $numeroIdentificacion, $ciudadExpedicion, $fechaNacimiento, $solicitud_id,
    $fechaSolicitud, $id_nivelEstudio, $id_genero, $id_ocupacion, $id_poblacion,
    $numeroIdentificacion_id, $fechaActual, $barrio_id, $direccion_id, $ubicacion,
    $accion_comunal, $electoral, $sisben, $cedula, $estado_id, $estado_id2, $detalles, $visible = false, $showForm = false, $showAdditional = false, $showValidar = false,
    $modalRechazada = false, $validacion1, $validacion2, $notas, $nombre, $validador, $Id, $AllStatus, $nameAll, $observaciones;
    public $fotosFrente = [];
    public $fotosMatricula = [];
    public $latFrente, $lngFrente;
    public $latMatricula, $lngMatricula;
    public $solicitud;

    public $solicitud_avecindamiento;
    public $coordenadasFrente = [];
    public $coordenadasMatricula = [];
    public $evidencia_residencia;
    public $tiempo_residencia_anios;
    public $tiempo_residencia_meses;








    protected $rules = [
        'estado_id' => 'required|string',
        'estado_id2' => 'required|exists:estados,id', // Validación para el estado
        'detalles' => 'required|string',
        'visible' => 'nullable|boolean',
        'fotosFrente' => 'nullable|array',
        'fotosFrente.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'fotosMatricula' => 'nullable|array',
        'fotosMatricula.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'evidencia_residencia' => 'required|boolean',
        'tiempo_residencia_anios' => 'required|integer|min:0',
        'tiempo_residencia_meses' => 'required|integer|min:0|max:11',
    ];

    //mostar validaciones en español
    protected $messages = [
        'estado_id.required' => 'El campo "Primer filtro" es obligatorio.',
        'estado_id2.required' => 'El campo "Segundo filtro" es obligatorio.',
        'estado_id2.exists' => 'El estado seleccionado no es válido.',
        'detalles.required' => 'El campo "Observaciones" es obligatorio.',
        'visible.boolean' => 'El campo "Habilitar visualización" debe ser verdadero o falso.',
        'evidencia_residencia.required' => 'El campo "Evidencia de residencia" es obligatorio.',
        'tiempo_residencia_anios.required' => 'El campo "Años de residencia" es obligatorio.',
        'tiempo_residencia_anios.integer' => 'El campo "Años de residencia" debe ser un número entero.',
        'tiempo_residencia_anios.min' => 'El campo "Años de residencia" debe ser al menos 0.',
        'tiempo_residencia_meses.required' => 'El campo "Meses de residencia" es obligatorio.',
        'tiempo_residencia_meses.integer' => 'El campo "Meses de residencia" debe ser un número entero.',
        'tiempo_residencia_meses.min' => 'El campo "Meses de residencia" debe ser al menos 0.',
    ];



    protected $listeners = ['edit', 'delete', 'view', 'procesar', 'see', 'validar', 'rechazar', 'confirmSave' => 'handleSave'];

    public function view($Id)
    {
        // obtener el user_id del id de la solicitud
        $solicitud = SolicitudAvecindamiento::find($Id);

        $user = User::find($solicitud->user_id);
        // Concatenando los nombres
        $this->nombreCompleto = $solicitud->NombreCompleto;
        ;
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
        // Obtener la solicitud con imágenes
        $solicitud = SolicitudAvecindamiento::with('imagenes', 'user', 'validaciones')->find($Id);
        if (!$solicitud) {
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'La solicitud no existe.');
            return;
        }

        // Obtener la primera validación relacionada con la solicitud (si existe)
        $validacion = $solicitud->validaciones->first();
        if (!$validacion) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Sin validaciones.', text: 'No se encontraron validaciones para esta solicitud.');
            return;
        }

        // Obtener el estado y validador relacionados
        $estado = Estado::find($validacion->validacion2);
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


        // logger()->info('coordenadasFrente', $this->coordenadasFrente);


        // Asignar solicitud completa como propiedad para el modal
        $this->solicitud_avecindamiento = $solicitud;

        // Asignar valores a las propiedades del modal
        $this->validacion1 = $validacion->validacion1;
        $this->validacion2 = $estado->nombreEstado ?? '—';
        $this->notas = $validacion->notas;
        $this->visible = $validacion->visible;

        $this->evidencia_residencia = $validacion->evidencia_residencia;

        $tiempo = json_decode($validacion->tiempo_residencia, true);
        $this->tiempo_residencia_anios = $tiempo['anios'] ?? null;
        $this->tiempo_residencia_meses = $tiempo['meses'] ?? null;

        $this->cedula = $solicitud->numeroIdentificacion;
        $this->nombre = $solicitud->user->name ?? '—';
        $this->nameAll = $solicitud->NombreCompleto ?? '—';
        $this->validador = $validador ? ($validador->name . ' | ' . $validador->codigo) : '—';

        $this->showAdditional = true;
    }


    public function validar($Id)
    {
        // validar si el usuario cuenta con cargo y firma
        $user = User::find(Auth::id());
        if (!$user->hasCompleteProfile()) {
            $this->dispatch(
                'sweet-alert-good',
                icon: 'info',
                title: 'Falta información',
                text: 'Debes completar tu información de cargo y firma para validar solicitudes.',
                footer: '<a href="user/profile">Finalizar mi perfil de validador</a>'
            );
            return;
        }

        $this->Id = $Id;
        $this->dispatch(
            'alert',
            icon: 'info',
            title: '¿Estás seguro?',
            text: 'Vas a confirmar la solicitud'
        );
    }

    public function validarsweet()
    {
        DB::beginTransaction(); // Inicia una transacción

        try {
            // Buscar la solicitud
            $solicitud = SolicitudAvecindamiento::find($this->Id);

            if (!$solicitud) {
                throw new \Exception('Solicitud no encontrada.');
            }

            // Generar URL del QR
            $baseUrl = config('app.url');
            $qrUrl = $baseUrl . '/qr-avecindamiento/' . $solicitud->id . '/' . $solicitud->numeroIdentificacion;

            // Asegurar que la carpeta de almacenamiento exista
            $qrStoragePath = storage_path('app/public/qrs');
            if (!is_dir($qrStoragePath)) {
                if (!mkdir($qrStoragePath, 0755, true) && !is_dir($qrStoragePath)) {
                    throw new \Exception('No se pudo crear el directorio para el QR.');
                }
            }

            // Generar el código QR
            $barcode = new DNS2D();
            $qrImageContent = $barcode->getBarcodePNG($qrUrl, 'QRCODE', 10, 10);

            // Verificar si el QR se generó correctamente
            if (!$qrImageContent) {
                throw new \Exception('No se pudo generar el código QR.');
            }

            // Guardar el QR en un archivo
            $qrPath = 'qrs/' . $solicitud->id . '.png';
            $qrFullPath = storage_path('app/public/' . $qrPath);
            file_put_contents($qrFullPath, base64_decode($qrImageContent));

            // Verificar si el archivo se guardó correctamente
            if (!file_exists($qrFullPath)) {
                throw new \Exception('No se pudo guardar el código QR.');
            }

            // Buscar o crear la validación y actualizarla
            $validacion = ValidacionAvecindamiento::firstOrCreate(
                ['id_solicitud' => $solicitud->id],
                ['qr_url' => $qrPath]
            );

            $validacion->update(['qr_url' => $qrPath]);

            // Ahora sí actualizamos la solicitud y enviamos el correo
            $solicitud->update([
                'estado_id' => 5,
                'fecha_emision' => now(),
                'Validador2_id' => Auth::id(),
            ]);

            $userName = $solicitud->user->name;
            $userEmail = $solicitud->user->email;

            // Enviar correo
            Mail::to($userEmail)->send(new \App\Mail\SolicitudAvecindamientoEmitidaNotification($solicitud->id, $userName));

            DB::commit(); // Si todo salió bien, se confirman los cambios

            // Notificar éxito
            $this->dispatch('Updated');
            $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Solicitud emitida con éxito.');

        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios si hay error

            // Mostrar error
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: $e->getMessage());
        }
    }

    public function rechazar($Id)
    {
        // validar si el usuario cuenta con cargo y firma
        $user = User::find(Auth::id());
        if (!$user->hasCompleteProfile()) {
            $this->dispatch(
                'sweet-alert-good',
                icon: 'info',
                title: 'Falta información',
                text: 'Debes completar tu información de cargo y firma para validar solicitudes.',
                footer: '<a href="user/profile">Finalizar mi perfil de validador</a>'
            );
            return;
        }
        $this->Id = $Id;
        $this->dispatch(
            '2alert',
            icon: 'info',
            title: '¿Estás seguro?',
            text: 'Vas a rechazar esta solicitud'
        );
    }

    public function modalRechazar()
    {
        // Obtener la solicitud por su ID
        $solicitud = SolicitudAvecindamiento::find($this->Id);
        // Obtener la primera validación relacionada con la solicitud (si existe)
        $validacion = $solicitud->validaciones()->first();
        //obtener el nombre del validador $solicitud->actualizado_por
        $validador = User::find($solicitud->actualizado_por);

        $this->cedula = $solicitud->numeroIdentificacion;
        $this->nombre = $solicitud->user->name;
        $this->nameAll = $solicitud->NombreCompleto;
        $this->observaciones = $validacion->notas;
        $this->validador = $validador->name . ' | ' . $validador->codigo;

        $this->modalRechazada = true;
    }

    public function rechazarsweet()
    {

        $solicitud = SolicitudAvecindamiento::find($this->Id);

        $validacion = $solicitud->validaciones()->first();

        if (!$solicitud) {
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'Solicitud no encontrada.');
            return;
        }

        $solicitud->update([
            'estado_id' => 3,
            'fecha_emision' => now(),
            'Validador2_id' => Auth::id()
        ]);

        $validacion->update([
            'notas' => $this->observaciones,
        ]);



        $userName = $solicitud->user->name; // Nombre del usuario
        $userEmail = $solicitud->user->email; // Email del usuario

        // Enviar correo de rechazo
        Mail::to($userEmail)->send(new \App\Mail\SolicitudAvecindamientoRechazadaNotification($solicitud->id, $userName));
        $this->modalRechazada = false;
        $this->resetForm();

        $this->dispatch('Updated');

        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Solicitud no completado con exito.');

    }

    // enviar datos a modal procesar para que el validador 1 cambie el estado
    public function procesar($Id)
    {
        // Bloquear la solicitud mientras se procesa para evitar concurrencia
        $solicitud = SolicitudAvecindamiento::where('id', $Id)->lockForUpdate()->first();
        // obtener el usuario de esta solicitud
        $user = User::find($solicitud->user_id);

        // Obtener el ID de los estados "Pendiente" y "En revisión"
        $pendienteId = 1; // ID de "Pendiente" (ajústalo según el estado real)
        $enRevisionId = 4;

        // Verificar si la solicitud ya ha cambiado de estado a algo diferente a "Pendiente" o "En revisión"
        if ($solicitud->estado_id != $pendienteId && $solicitud->estado_id != $enRevisionId) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud ya procesada.', text: 'Esta solicitud ya fue emitida, no completado o procesada por otro validador.');
            $this->dispatch('Updated');
            return;
        }

        // Refrescar el modelo para obtener la información más actualizada
        $solicitud->refresh();

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
            $this->nameAll = $solicitud->NombreCompleto;
            $this->resetForm();
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
        $this->nameAll = $solicitud->NombreCompleto;
        $this->resetForm();
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
            $solicitud = SolicitudAvecindamiento::find($this->solicitud_id);

            // Cambiar el estado a pendiente y eliminar el bloqueo del validador
            $solicitud->update([
                'estado_id' => 1, // Estado "Pendiente"
                'actualizado_por' => null
            ]);

            $this->solicitud_id = null;
            $this->showValidar = false;
            $this->resetForm();
            $this->dispatch('Updated');
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud liberada', text: 'Has liberado la solicitud. Ahora otros validadores pueden revisarla.');
        }
    }

    public function save()
    {
        $this->dispatch('confirm-save');
    }

    public function handleSave()
    {
        try {
            $this->validate();

            if ($this->solicitud_id) {
                $solicitud = SolicitudAvecindamiento::find($this->solicitud_id);

                // Lógica para determinar el estado final
                $estadoFinal = ($this->estado_id === 'Avanzar' && $this->estado_id2 === '2') ? 2 : 3; // 2 = Procesando, 3 = no completado

                $solicitud->update([
                    'estado_id' => $estadoFinal,
                    'actualizado_por' => auth()->id(), // Liberar la solicitud
                ]);

                $userName = $solicitud->user->name; // Nombre del usuario
                $userEmail = $solicitud->user->email; // Email del usuario

                if ($estadoFinal === 3) {
                    // Enviar correo de rechazo
                    Mail::to($userEmail)->send(new \App\Mail\SolicitudAvecindamientoRechazadaNotification($solicitud->id, $userName));
                }


                if (!empty($this->fotosFrente)) {
                    foreach ($this->fotosFrente as $foto) {
                        $path = $foto->store('imagenes/frente', 'public');
                        Imagen::create([
                            'solicitud_id' => $solicitud->id,
                            'ruta' => $path,
                            'tipo' => 'frente',
                            'lat' => $this->latFrente,
                            'lng' => $this->lngFrente,
                        ]);
                    }
                }

                if (!empty($this->fotosMatricula)) {
                    foreach ($this->fotosMatricula as $foto) {
                        $path = $foto->store('imagenes/matricula', 'public');
                        Imagen::create([
                            'solicitud_id' => $solicitud->id,
                            'ruta' => $path,
                            'tipo' => 'matricula',
                            'lat' => $this->latMatricula,
                            'lng' => $this->lngMatricula,
                        ]);
                    }
                }

                try {
                    $solicitud->validaciones()->create([
                        'validacion1' => $this->estado_id,
                        'validacion2' => $this->estado_id2,
                        'notas' => $this->detalles,
                        'visible' => $this->visible,
                        'evidencia_residencia' => $this->evidencia_residencia, // Nuevo campo boolean
                        'tiempo_residencia' => json_encode([ // Nuevo campo JSON
                            'anios' => $this->tiempo_residencia_anios,
                            'meses' => $this->tiempo_residencia_meses,
                        ]),
                    ]);

                    $this->dispatch('sweet-alert-good', icon: 'success', title: 'Validación creada con éxito.', text: 'La validación se ha guardado correctamente.');
                    $this->dispatch('Updated');

                } catch (\Exception $e) {
                    $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'Error al guardar la validación.');
                    $this->dispatch('Updated');

                }
            }

            $this->showValidar = false;
            $this->resetForm();
            $this->dispatch('updated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
        }
    }



    public function edit($Id)
    {
        $solicitud = SolicitudAvecindamiento::find($Id);

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
        $solicitud = SolicitudAvecindamiento::find($Id);
        $solicitud->delete();
        $this->dispatch('Updated');
    }

    // limpiar campos
    public function resetForm()
    {
        $this->detalles = '';
        $this->estado_id2 = null;
        $this->estado_id = null;
        $this->visible = false;

        // Nuevas propiedades para imágenes y coordenadas
        $this->fotosFrente = [];
        $this->fotosMatricula = [];
        $this->latFrente = null;
        $this->lngFrente = null;
        $this->latMatricula = null;
        $this->lngMatricula = null;
    }


    //datos del model
    public function render()
    {
        // estados, solo pasar los estados con id 1, 2 y 3
        $estados = Estado::whereIn('id', [2, 3])->get();

        return view('livewire.solicitud-avecindamiento-component', [
            'solicitudes' => SolicitudAvecindamiento::with('barrio', 'direccion'), // Paginación de 10 elementos
            'estados' => $estados
        ]);
    }
}
