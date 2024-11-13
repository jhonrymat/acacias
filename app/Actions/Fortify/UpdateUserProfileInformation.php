<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
            // la firma no es obligatoria, debe ser un archivo de imagen
            'firma' => ['nullable', 'mimes:jpg,jpeg,png'],
            // codigo
            'codigo' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);

        } else {
            $userData = [
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
            ];
            // Verificar si el usuario tiene el rol validador2 y se ha subido una firma
            if (isset($input['firma'])) {
                try {
                    // Obtener el archivo de la firma
                    $file = $input['firma'];

                    if ($file) {
                        // Obtener el nombre original del archivo
                        $originalName = $file->getClientOriginalName();
                        // Obtener la extensión del archivo
                        $extension = $file->getClientOriginalExtension();
                        // Crear un nombre único: nombre original + fecha y hora
                        $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . now()->format('Ymd_His') . '.' . $extension;
                        // Guardar el archivo en la carpeta "validador2"
                        $path = $file->storeAs('validador2', $fileName, 'public');
                        // Almacenar la ruta de la firma en el array $userData
                        $userData['firma'] = $path;
                    }
                } catch (\Exception $e) {
                    // En caso de error, mostrar un mensaje de error
                    session()->flash('error', 'Error al subir la firma');
                }
            }

            $user->forceFill($userData)->save();
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
