<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'nombre_2' => ['required', 'string', 'max:255'],
            'apellido_1' => ['required', 'string', 'max:255'],
            'apellido_2' => ['required', 'string', 'max:255'],
            'telefonoContacto' => ['required', 'string', 'max:255'],
            'fechaNacimiento' => ['required', 'string', 'max:255'],
            'id_tipoSolicitante' => ['required', 'exists:tsolicitantes,id'],
            'id_tipoDocumento' => ['required'],
            'numeroIdentificacion' => ['required', 'string', 'max:255'],
            'ciudadExpedicion' => ['required', 'string', 'max:255'],
            'id_nivelEstudio' => ['required'],
            'id_genero' => ['required'],
            'id_ocupacion' => ['required'],
            'id_poblacion' => ['required'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'nombre_2' => $input['nombre_2'],
                'apellido_1' => $input['apellido_1'],
                'apellido_2' => $input['apellido_2'],
                'telefonoContacto' => $input['telefonoContacto'],
                'fechaNacimiento' => $input['fechaNacimiento'],
                'id_tipoSolicitante' => $input['id_tipoSolicitante'],
                'id_tipoDocumento' => $input['id_tipoDocumento'],
                'numeroIdentificacion' => $input['numeroIdentificacion'],
                'ciudadExpedicion' => $input['ciudadExpedicion'],
                'id_nivelEstudio' => $input['id_nivelEstudio'],
                'id_genero' => $input['id_genero'],
                'id_ocupacion' => $input['id_ocupacion'],
                'id_poblacion' => $input['id_poblacion'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
