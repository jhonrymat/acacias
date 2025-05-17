<?php

namespace App\Actions\Fortify;

use App\Models\Pais;
// paises
use App\Models\User;
use App\Models\Ciudad;
use App\Models\Departamento;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */

    public function create(array $input): User
    {
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nombre_2' => ['nullable', 'string', 'max:255'],
            'apellido_1' => ['required', 'string', 'max:255'],
            'apellido_2' => ['nullable', 'string', 'max:255'],
            'telefonoContacto' => ['required', 'numeric', 'digits:10', 'unique:users,telefonoContacto'],
            'fechaNacimiento' => ['required', 'string', 'max:255'],
            'id_tipoSolicitante' => ['required', 'string', 'max:255'],
            'id_tipoDocumento' => ['required', 'string', 'max:255'],
            'numeroIdentificacion' => ['required', 'numeric', 'digits_between:5,12', 'unique:users,numeroIdentificacion'],
            'country' => 'required|exists:paises,id',
            'department' => 'nullable|exists:departamentos,id',
            'city' => 'nullable|exists:ciudades,id',
            'id_nivelEstudio' => ['required', 'string', 'max:255'],
            'id_genero' => ['required', 'string', 'max:255'],
            'id_ocupacion' => ['required', 'string', 'max:255'],
            'id_poblacion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        // Validar campos adicionales si el país es Colombia
        if ($input['country'] == 1) { // ID de Colombia
            if (empty($input['department']) || !Departamento::where('id', $input['department'])->exists()) {
                throw ValidationException::withMessages(['department' => 'El campo departamento es obligatorio para Colombia.']);
            }

            if (empty($input['city']) || !Ciudad::where('id', $input['city'])->exists()) {
                throw ValidationException::withMessages(['city' => 'El campo ciudad es obligatorio para Colombia.']);
            }
        }

        $validator->setCustomMessages(['name.required' => 'El campo nombre es obligatorio.', 'name.string' => 'El campo nombre debe ser una cadena de texto.', 'name.max' => 'El campo nombre no debe exceder los 255 caracteres.', 'apellido_1.required' => 'El campo primer apellido es obligatorio.', 'telefonoContacto.unique' => 'El numero de telefono ya existe', 'telefonoContacto.required' => 'El campo teléfono de contacto es obligatorio.', 'telefonoContacto.numeric' => 'El telefono solo debe ser numeros', 'telefonoContacto.digits' => 'El telefono debe contener 10 digitos', 'fechaNacimiento.required' => 'El campo fecha de nacimiento es obligatorio.', 'id_tipoSolicitante.required' => 'El campo tipo de solicitante es obligatorio.', 'id_tipoDocumento.required' => 'El campo tipo de documento es obligatorio.', 'numeroIdentificacion.unique' => 'El documento ya está registrado.', 'numeroIdentificacion.required' => 'El campo número de identificación es obligatorio.', 'numeroIdentificacion.numeric' => 'Solo puede ingresar numeros.', 'numeroIdentificacion.min' => 'La identificación debe tener al minimo 10 numeros', 'numeroIdentificacion.digits_between' => 'El número de identificación debe tener min 5 y max 12 dígitos.', 'country.required' => 'El campo país es obligatorio.', 'id_nivelEstudio.required' => 'El campo nivel de estudio es obligatorio.', 'id_genero.required' => 'El campo género es obligatorio.', 'id_ocupacion.required' => 'El campo ocupación es obligatorio.', 'id_poblacion.required' => 'El campo población es obligatorio.', 'email.required' => 'El campo correo electrónico es obligatorio.', 'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.', 'email.unique' => 'El correo electrónico ya está registrado.', 'password.required' => 'El campo contraseña es obligatorio.', 'terms.accepted' => 'Debes aceptar los términos y condiciones.',]);
        $validator->validate();


        // Verificar si el país está seleccionado
        $pais = Pais::find($input['country']);

        $ciudadExpedicion = $pais ? "{$pais->nombre}" : 'Desconocido';

        // Si el país es Colombia, agregar departamento y ciudad
        if ($pais && $pais->nombre === 'Colombia') {
            $departamento = !empty($input['department']) ? Departamento::find($input['department']) : null;
            $ciudad = !empty($input['city']) ? Ciudad::find($input['city']) : null;

            $ciudadExpedicion = "{$pais->nombre}, " .
                ($departamento ? $departamento->nombre : '') . ", " .
                ($ciudad ? $ciudad->nombre : '');
        }




        $user = User::create([
            'name' => $input['name'],
            'nombre_2' => $input['nombre_2'] ?? null,
            'apellido_1' => $input['apellido_1'],
            'apellido_2' => $input['apellido_2'] ?? null,
            'telefonoContacto' => $input['telefonoContacto'],
            'fechaNacimiento' => $input['fechaNacimiento'],
            'id_tipoSolicitante' => $input['id_tipoSolicitante'],
            'id_tipoDocumento' => $input['id_tipoDocumento'],
            'numeroIdentificacion' => $input['numeroIdentificacion'],
            'ciudadExpedicion' => $ciudadExpedicion,
            'id_nivelEstudio' => $input['id_nivelEstudio'],
            'id_genero' => $input['id_genero'],
            'id_ocupacion' => $input['id_ocupacion'],
            'id_poblacion' => $input['id_poblacion'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('user');
        return $user;
    }
}
