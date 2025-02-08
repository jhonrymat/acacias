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
    public function update(\Illuminate\Foundation\Auth\User $user, array $input): void
    {
        try {
            // Validación de los datos
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'nombre_2' => ['nullable', 'string', 'max:255'],
                'apellido_1' => ['required', 'string', 'max:255'],
                'apellido_2' => ['nullable', 'string', 'max:255'],
                'telefonoContacto' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users', 'telefonoContacto')->ignore($user->id),
                ],
                'fechaNacimiento' => ['required', 'string', 'max:255'],
                'cargo' => ['nullable', 'string', 'max:100'],
                'id_tipoSolicitante' => ['required', 'exists:tsolicitantes,id'],
                'id_tipoDocumento' => ['required'],
                'numeroIdentificacion' => ['required', 'string', 'max:255'],
                'ciudadExpedicion' => ['required', 'string', 'max:255'],
                'id_nivelEstudio' => ['required'],
                'id_genero' => ['required'],
                'id_ocupacion' => ['required'],
                'id_poblacion' => ['required'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)
                ],
                'firma' => ['nullable', 'sometimes', 'max:10240'],
                'codigo' => ['nullable', 'string', 'max:255'],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');

            // Verificar si el email ya existe en otro usuario
            if (User::where('email', $input['email'])->where('id', '<>', $user->id)->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => ['El correo electrónico ya está en uso por otro usuario.']
                ]);
            }

            // Actualizar la foto de perfil si se envió
            if (isset($input['photo'])) {
                $user->updateProfilePhoto($input['photo']);
            }

            // Si cambia el email y el usuario requiere verificación
            if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
                $this->updateVerifiedUser($user, $input);
            } else {
                $userData = [
                    'name' => $input['name'],
                    'nombre_2' => $input['nombre_2'],
                    'apellido_1' => $input['apellido_1'],
                    'apellido_2' => $input['apellido_2'],
                    'telefonoContacto' => $input['telefonoContacto'],
                    'fechaNacimiento' => $input['fechaNacimiento'],
                    'cargo' => $input['cargo'],
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

                // Manejo de la firma si el usuario es "validador2"
                if (isset($input['firma']) && $input['firma'] instanceof \Illuminate\Http\UploadedFile) {
                    try {
                        $file = $input['firma'];
                        if ($file) {
                            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . now()->format('Ymd_His') . '.' . $file->getClientOriginalExtension();
                            $path = $file->storeAs('validador2', $fileName, 'public');
                            $userData['firma'] = $path;
                        }
                    } catch (\Exception $e) {
                        session()->flash('error', 'Error al subir la firma');
                    }
                }

                // Intentar guardar los cambios en la base de datos
                try {
                    $user->forceFill($userData)->save();
                } catch (\Illuminate\Database\QueryException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        \Log::error("Intento de actualización con correo duplicado: " . $input['email']);
                        throw \Illuminate\Validation\ValidationException::withMessages([
                            'email' => ['El correo electrónico ya está en uso.']
                        ]);
                    } else {
                        throw $e;
                    }
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Error de validación: ' . $e->getMessage());
            throw $e; // Lanza el error para que Laravel maneje la respuesta en el frontend
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
