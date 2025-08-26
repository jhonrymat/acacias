<?php

namespace App\Livewire;

use App\Models\SolicitudAvecindamiento;
use App\Models\ValidacionAvecindamiento;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Anulacion;
use App\Models\Solicitud;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;

class CiudadanosComponent extends Component
{
    public $Id, $name, $nombre_2, $apellido_1, $apellido_2, $email, $password, $password_confirmation, $telefonoContacto, $numeroIdentificacion, $fechaNacimiento;
    public $id_tipoSolicitante = 1; // Tipo solicitante predeterminado
    public $id_tipoDocumento = 1; // Tipo documento predeterminado
    public $ciudadExpedicion = 'Sin especificar'; // Ciudad por defecto
    public $showModal = false;
    public $showModalHistory = false;
    public $showModalHistoryAvecindamiento = false;
    public $historial;
    public $historial_avecindamiento;
    protected $listeners = ['edit', 'history', 'historyAvecindamiento', 'generarPDF', 'generarPDFAvecindamiento', 'generarActaAvecindamiento'];

    // Ver por que se anulo la solicitud
    public $mostrarModal = false;
    public $descripcionAnulacion, $archivoAnulacion, $visibleAnulacion;


    public function mount()
    {
        $this->historial = collect(); // 🔹 Inicializar como una colección vacía de Eloquent
        $this->historial_avecindamiento = collect(); // 🔹 Inicializar como una colección vacía de Eloquent
    }


    protected $rules = [
        'password' => ['nullable', 'min:8', 'same:password_confirmation'],
        'numeroIdentificacion' => ['required', 'numeric', 'digits_between:5,12', 'unique:users,numeroIdentificacion'],
        'telefonoContacto' => ['required', 'numeric', 'digits:10', 'unique:users,telefonoContacto'],
        'email' => ['required', 'email', 'unique:users,email'],
    ];


    protected $message = [
        'password.required' => 'El campo contraseña es obligatorio.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.same' => 'Las contraseñas no coinciden.',
        'numeroIdentificacion.required' => 'El campo número de identificación es obligatorio.',
        'numeroIdentificacion.numeric' => 'Solo puede ingresar números.',
        'numeroIdentificacion.digits_between' => 'El número de identificación debe tener entre 5 y 12 dígitos.',
        'numeroIdentificacion.unique' => 'El número de identificación ya está registrado.',
        'telefonoContacto.required' => 'El campo teléfono de contacto es obligatorio.',
        'telefonoContacto.numeric' => 'El teléfono solo debe contener números.',
        'telefonoContacto.digits' => 'El teléfono debe contener 10 dígitos.',
        'telefonoContacto.unique' => 'El teléfono de contacto ya está registrado.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
        'email.unique' => 'El correo electrónico ya está registrado.',
    ];

    protected $validationAttributes = [
        'name' => 'nombre',
        'nombre_2' => 'segundo nombre',
        'apellido_1' => 'primer apellido',
        'apellido_2' => 'segundo apellido',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña',
        'telefonoContacto' => 'teléfono de contacto',
        'numeroIdentificacion' => 'número de identificación',
        'fechaNacimiento' => 'fecha de nacimiento',
    ];

    // metodo para ver la anulacion
    public function verAnulacion($solicitudId)
    {
        // Buscar la anulación de la solicitud
        $anulacion = Anulacion::where('solicitud_id', $solicitudId)->first();

        if ($anulacion) {
            $this->descripcionAnulacion = $anulacion->descripcion;
            $this->archivoAnulacion = $anulacion->archivo;
            $this->visibleAnulacion = $anulacion->visible;

            // Mostrar el modal
            $this->mostrarModal = true;
        } else {
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'No se encontró información de anulación.');
        }
    }


    // edit
    public function edit($Id)
    {
        $ciudadano = User::find($Id);
        $this->Id = $ciudadano->id;
        $this->name = $ciudadano->name;
        $this->nombre_2 = $ciudadano->nombre_2;
        $this->apellido_1 = $ciudadano->apellido_1;
        $this->apellido_2 = $ciudadano->apellido_2;
        $this->email = $ciudadano->email;
        $this->telefonoContacto = $ciudadano->telefonoContacto;
        $this->numeroIdentificacion = $ciudadano->numeroIdentificacion;
        $this->fechaNacimiento = $ciudadano->fechaNacimiento;
        $this->showModal = true;
    }

    // history
    public function history($Id)
    {
        $ciudadano = User::with('solicitudes')->find($Id);
        if (!$ciudadano) {
            abort(404, "Usuario no encontrado");
        }

        $this->historial = $ciudadano->solicitudes;
        $this->showModalHistory = true;

    }
    public function historyAvecindamiento($Id)
    {

        $ciudadano_Avecindamiento = User::with('SolicitudesAvecindamiento')->find($Id);
        if (!$ciudadano_Avecindamiento) {
            abort(404, "Usuario no encontrado");
        }

        $this->historial_avecindamiento = $ciudadano_Avecindamiento->solicitudesAvecindamiento;
        $this->showModalHistoryAvecindamiento = true;

    }

    // save
    public function save()
    {
        $rules = $this->rules;

        if ($this->Id) {
            $rules['numeroIdentificacion'] = ['required', 'numeric', 'digits_between:5,12', 'unique:users,numeroIdentificacion,' . $this->Id];
            $rules['telefonoContacto'] = ['required', 'numeric', 'digits:10', 'unique:users,telefonoContacto,' . $this->Id];
            $rules['email'] = ['required', 'email', 'unique:users,email,' . $this->Id];
        }

        $this->validate($rules, $this->message);

        if ($this->Id) {
            // Editar ciudadano existente
            $this->updateCiudadano();
        } else {
            // Crear nuevo ciudadano
            $this->createCiudadano();
        }

        $this->showModal = false;

    }

    // createCiudadano
    public function createCiudadano()
    {
        $ciudadano = User::create([
            'name' => $this->name,
            'nombre_2' => $this->nombre_2,
            'apellido_1' => $this->apellido_1,
            'apellido_2' => $this->apellido_2,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'telefonoContacto' => $this->telefonoContacto,
            'numeroIdentificacion' => $this->numeroIdentificacion,
            'fechaNacimiento' => $this->fechaNacimiento,
            'id_tipoSolicitante' => $this->id_tipoSolicitante, // Valor predeterminado
            'id_tipoDocumento' => $this->id_tipoDocumento, // Valor predeterminado
            'ciudadExpedicion' => $this->ciudadExpedicion, // Valor predeterminado
        ]);

        $ciudadano->assignRole('user');
        $this->dispatch('refresh-data-table');
        $this->resetForm();
        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Operación completada con éxito.', text: 'Ciudadano creado.');

    }

    // updateCiudadano
    public function updateCiudadano()
    {
        $ciudadano = User::find($this->Id);

        $ciudadano->name = $this->name;
        $ciudadano->nombre_2 = $this->nombre_2;
        $ciudadano->apellido_1 = $this->apellido_1;
        $ciudadano->apellido_2 = $this->apellido_2;
        $ciudadano->email = $this->email;
        $ciudadano->telefonoContacto = $this->telefonoContacto;
        $ciudadano->numeroIdentificacion = $this->numeroIdentificacion;
        $ciudadano->fechaNacimiento = $this->fechaNacimiento;

        if (!empty($this->password)) {
            $ciudadano->password = Hash::make($this->password);
        }

        $ciudadano->save();
        $this->dispatch('refresh-data-table');
        $this->resetForm();
        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Operación completada con éxito.', text: 'Ciudadano actualizado.');

    }

    public function nuevoCiudadano()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModalHistory = false;
    }

    // resetForm
    public function resetForm()
    {
        $this->Id = null;
        $this->name = '';
        $this->nombre_2 = '';
        $this->apellido_1 = '';
        $this->apellido_2 = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->telefonoContacto = '';
        $this->numeroIdentificacion = '';
        $this->fechaNacimiento = '';
    }

    public function generarPDF($Id)
    {
        $solicitud = Solicitud::findOrFail($Id);

        // Validar el estado de la solicitud
        // Permitir Emitido (5), Por vencer (6) y Vencido (7)
        if (!in_array($solicitud->estado_id, [5, 6, 7], true)) {
            session()->flash('error', 'La solicitud no está emitida, por vencer o vencida.');
            return;
        }

        // Datos dinámicos para la plantilla
        $data = [
            'id' => $solicitud->id,
            'solicitante' => trim(
                $solicitud->user->name
                . ' '
                . ($solicitud->user->nombre_2 ?? '')
                . ' '
                . $solicitud->user->apellido_1
                . ' '
                . ($solicitud->user->apellido_2 ?? '')
            ),
            'tipoDocumento' => $solicitud->user->tipoDocumento->tipoDocumento,
            'cedula' => $solicitud->numeroIdentificacion,
            'direccion' => $solicitud->direccion,
            'cargo' => $solicitud->validador2->cargo,
            'validador' => trim(
                $solicitud->validador2->name
                . ' '
                . ($solicitud->validador2->nombre_2 ?? '')
                . ' '
                . $solicitud->validador2->apellido_1
                . ' '
                . ($solicitud->validador2->apellido_2 ?? '')
            ),
            'codigo_validador1' => $solicitud->actualizador->codigo,
            'firma' => $solicitud->validador2->firma,
            'ciudad_expedicion' => $solicitud->user->ciudadExpedicion,
            'barrio_vereda' => $solicitud->barrio->nombreBarrio,
            'tipo_unidad' => $solicitud->barrio->tipoUnidad,
            'codigo_numero' => $solicitud->barrio->codigoNumero,
            'zona' => $solicitud->barrio->zona,
            'estado' => $solicitud->estado->nombreEstado,
            'numero_certificado' => $solicitud->numeroIdentificacion,
            'fecha_emision' => $solicitud->fecha_emision
                ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                : 'N/A',
            'vigencia_inicio' => $solicitud->fecha_emision
                ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                : 'N/A',

            'vigencia_fin' => $solicitud->VigenciaFormateada,

            'verificacion_url' => env('APP_URL') . '/consulta-tramite',
            'qr' => public_path('storage/' . $solicitud->validaciones->first()->qr_url),
        ];

        // Generar el PDF
        $pdf = Pdf::loadView('certificados.certificado', $data);

        // Descargar el archivo
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $solicitud->id . '_' . $solicitud->numeroIdentificacion . '_certificado.pdf');
    }

    public function generarPDFAvecindamiento($Id)
    {
        $solicitud = SolicitudAvecindamiento::findOrFail($Id);
        $validacion = ValidacionAvecindamiento::where('id_solicitud', $Id)->first();
        if (!$validacion) {
            session()->flash('error', 'No se encontró la validación de la solicitud.');
            return;
        }

        // Validar el estado de la solicitud
        if (!in_array($solicitud->estado_id, [5, 6, 7], true)) {
            session()->flash('error', 'La solicitud no está emitida, por vencer o vencida.');
            return;
        }

        // Datos dinámicos para la plantilla
        $data = [
            'id' => $solicitud->id,
            'solicitante' => trim(
                $solicitud->user->name
                . ' '
                . ($solicitud->user->nombre_2 ?? '')
                . ' '
                . $solicitud->user->apellido_1
                . ' '
                . ($solicitud->user->apellido_2 ?? '')
            ),
            'tipoDocumento' => $solicitud->user->tipoDocumento->tipoDocumento,
            'cedula' => $solicitud->numeroIdentificacion,
            'direccion' => $solicitud->direccion,
            'cargo' => $solicitud->validador2->cargo,
            'validador' => trim(
                $solicitud->validador2->name
                . ' '
                . ($solicitud->validador2->nombre_2 ?? '')
                . ' '
                . $solicitud->validador2->apellido_1
                . ' '
                . ($solicitud->validador2->apellido_2 ?? '')
            ),
            'codigo_validador1' => $solicitud->actualizador->codigo,
            'firma' => $solicitud->validador2->firma,
            'ciudad_expedicion' => $solicitud->user->ciudadExpedicion,
            'barrio_vereda' => $solicitud->barrio->nombreBarrio,
            'tipo_unidad' => $solicitud->barrio->tipoUnidad,
            'codigo_numero' => $solicitud->barrio->codigoNumero,
            'zona' => $solicitud->barrio->zona,
            'estado' => $solicitud->estado->nombreEstado,
            'numero_certificado' => $solicitud->numeroIdentificacion,
            'fecha_emision' => $solicitud->fecha_emision
                ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                : 'N/A',
            'vigencia_inicio' => $solicitud->fecha_emision
                ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                : 'N/A',

            'vigencia_fin' => $solicitud->VigenciaFormateada,
            'fecha_visita' => $validacion->created_at
                ? Carbon::parse($validacion->created_at)->translatedFormat('d \\de F \\de Y')
                : 'N/A',

            'verificacion_url' => env('APP_URL') . '/consulta-tramite',
            'qr' => public_path('storage/' . $solicitud->validaciones->first()->qr_url),
        ];

        // Generar el PDF
        $pdf = Pdf::loadView('certificados.certificadoAvecindamientoUsuario', $data);

        // Descargar el archivo
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $solicitud->id . '_' . $solicitud->numeroIdentificacion . '_certificadoAvecindamiento.pdf');
    }

    public function generarActaAvecindamiento($Id)
    {
        $solicitud = SolicitudAvecindamiento::findOrFail($Id);
        $validacion = ValidacionAvecindamiento::where('id_solicitud', $Id)->first();
        if (!$validacion) {
            session()->flash('error', 'No se encontró la validación de la solicitud.');
            return;
        }

        // Validar el estado de la solicitud
        if ($solicitud->estado_id !== 5) {
            session()->flash('error', 'La solicitud no está emitida.');
            return;
        }

        // Decodificar el campo JSON de tiempo de residencia
        $tiempoResidencia = json_decode($validacion->tiempo_residencia, true);


        // Datos dinámicos para la plantilla
        $data = [
            'id' => $solicitud->id,
            'solicitante' => trim(
                $solicitud->user->name
                . ' '
                . ($solicitud->user->nombre_2 ?? '')
                . ' '
                . $solicitud->user->apellido_1
                . ' '
                . ($solicitud->user->apellido_2 ?? '')
            ),
            'fecha_solicitud' => $solicitud->created_at
                ? Carbon::parse($solicitud->created_at)->translatedFormat('d \\de F \\de Y')
                : 'N/A',
            'tipoDocumento' => $solicitud->user->tipoDocumento->tipoDocumento,
            'cedula' => $solicitud->numeroIdentificacion,
            'ciudad_expedicion' => $solicitud->user->ciudadExpedicion,
            'telefono' => $solicitud->user->telefonoContacto,
            'direccion' => $solicitud->direccion,
            'barrio_vereda' => $solicitud->barrio->nombreBarrio,
            'tipo_unidad' => $solicitud->barrio->tipoUnidad,
            'codigo_numero' => $solicitud->barrio->codigoNumero,
            'zona' => $solicitud->barrio->zona,
            'fecha_visita' => $validacion->created_at
                ? Carbon::parse($validacion->created_at)->translatedFormat('d \\de F \\de Y')
                : 'N/A',
            'validador1' => trim(
                $solicitud->actualizador->name
                . ' '
                . ($solicitud->actualizador->nombre_2 ?? '')
                . ' '
                . $solicitud->actualizador->apellido_1
                . ' '
                . ($solicitud->actualizador->apellido_2 ?? '')
            ),
            'codigo_validador1' => $solicitud->actualizador->codigo,

            // ➡️ NUEVAS VARIABLES PARA LA PLANTILLA
            'evidencia_residencia' => $validacion->evidencia_residencia,
            'tiempo_residencia_anios' => $tiempoResidencia['anios'] ?? null,
            'tiempo_residencia_meses' => $tiempoResidencia['meses'] ?? null,

        ];

        // Generar el PDF
        $pdf = Pdf::loadView('certificados.certificadoAvecindamientoInterno', $data);

        // Descargar el archivo
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $solicitud->id . '_' . $solicitud->numeroIdentificacion . '_ActaAvecindamiento.pdf');
    }

    public function render()
    {
        return view('livewire.ciudadanos-component');
    }
}
