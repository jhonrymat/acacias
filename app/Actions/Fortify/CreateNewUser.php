<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nombre_2' => ['required', 'string', 'max:255'],
            'apellido_1' => ['required', 'string', 'max:255'],
            'apellido_2' => ['required', 'string', 'max:255'],
            'telefonoContacto' => ['required', 'string', 'max:255'],
            'fechaNacimiento' => ['required', 'string', 'max:255'],
            'id_tipoSolicitante' => ['required', 'string', 'max:255'],
            'id_tipoDocumento' => ['required', 'string', 'max:255'],
            'numeroIdentificacion' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'id_nivelEstudio' => ['required', 'string', 'max:255'],
            'id_genero' => ['required', 'string', 'max:255'],
            'id_ocupacion' => ['required', 'string', 'max:255'],
            'id_poblacion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Combinar los valores de país, departamento y ciudad en una sola columna
        $ciudadExpedicion = "{$input['country']}, {$input['department']}, {$input['city']}";

        $user = User::create([
            'name' => $input['name'],
            'nombre_2' => $input['nombre_2'],
            'apellido_1' => $input['apellido_1'],
            'apellido_2' => $input['apellido_2'],
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
