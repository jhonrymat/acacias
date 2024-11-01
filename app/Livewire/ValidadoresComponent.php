<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Tdocumento;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ValidadoresComponent extends Component
{
    public $Id, $name, $nombre_2, $apellido_1, $apellido_2, $email, $password, $password_confirmation, $telefonoContacto, $numeroIdentificacion, $fechaNacimiento, $codigo, $rol;
    public $showModal = false;
    protected $listeners = ['edit'];

    protected $rules = [
        'password' => 'nullable|min:8|same:password_confirmation',
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
        'codigo' => 'código',
        'rol' => 'rol',
    ];

    protected $messages = [
        'password.same' => 'Las contraseñas no coinciden. Por favor verifica e intenta de nuevo.',
    ];

    public function edit($Id)
    {
        $validador = User::find($Id);
        $this->Id = $validador->id;
        $this->name = $validador->name;
        $this->nombre_2 = $validador->nombre_2;
        $this->apellido_1 = $validador->apellido_1;
        $this->apellido_2 = $validador->apellido_2;
        $this->email = $validador->email;
        $this->telefonoContacto = $validador->telefonoContacto;
        $this->numeroIdentificacion = $validador->numeroIdentificacion;
        $this->fechaNacimiento = $validador->fechaNacimiento;
        $this->codigo = $validador->codigo;
        $this->rol = $validador->roles->pluck('name')->first();
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->Id) {
            // Editar validador existente
            $this->updateValidator();
        } else {
            // Crear nuevo validador
            $this->createValidator();
        }

        $this->showModal = false;
        $this->resetForm();

        session()->flash('message', 'Operación completada con éxito.');
    }


    public function createValidator()
    {
        $validador = User::create([
            'name' => $this->name,
            'nombre_2' => $this->nombre_2,
            'apellido_1' => $this->apellido_1,
            'apellido_2' => $this->apellido_2,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'telefonoContacto' => $this->telefonoContacto,
            'numeroIdentificacion' => $this->numeroIdentificacion,
            'fechaNacimiento' => $this->fechaNacimiento,
            'codigo' => $this->codigo,
            'id_tipoSolicitante' => 1,
            'id_tipoDocumento' => 1,
            'ciudadExpedicion' => 'NN',
        ]);

        $validador->assignRole($this->rol);
        $this->dispatch('sweet-alert-good', icon: 'info', title: 'Creado Correctamente', text: 'El validador ha sido creado correctamente.');

        $this->dispatch('Updated');
    }

    public function updateValidator()
    {
        $validador = User::find($this->Id);

        $validador->name = $this->name;
        $validador->nombre_2 = $this->nombre_2;
        $validador->apellido_1 = $this->apellido_1;
        $validador->apellido_2 = $this->apellido_2;
        $validador->email = $this->email;
        $validador->telefonoContacto = $this->telefonoContacto;
        $validador->numeroIdentificacion = $this->numeroIdentificacion;
        $validador->fechaNacimiento = $this->fechaNacimiento;
        $validador->codigo = $this->codigo;

        if (!empty($this->password)) {
            $validador->password = Hash::make($this->password);
        }

        $validador->save();
        $this->dispatch('sweet-alert-good', icon: 'info', title: 'Validador actualizado correctamente.', text: 'El validador ha sido actualizado correctamente.');
        $this->dispatch('Updated');
    }

    public function nuevoValidador()
    {
        // Limpiar todos los campos del formulario
        $this->resetForm();

        // Establecer showModal en true para abrir el modal
        $this->showModal = true;
    }


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
        $this->codigo = '';
        $this->rol = '';
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.validadores-component', [
            'roles' => $roles,
        ]);
    }
}
