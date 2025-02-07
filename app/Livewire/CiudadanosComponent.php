<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
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
    public $historial;
    protected $listeners = ['edit', 'history', 'generarPDF'];

    public function mount()
    {
        $this->historial = collect(); // 🔹 Inicializar como una colección vacía de Eloquent
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
        if ($solicitud->estado_id !== 5) {
            session()->flash('error', 'La solicitud no está emitida.');
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
    public function render()
    {
        return view('livewire.ciudadanos-component');
    }
}
