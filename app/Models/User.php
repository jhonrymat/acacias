<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nombre_2',
        'apellido_1',
        'apellido_2',
        'email',
        'password',
        'telefonoContacto',
        'id_tipoSolicitante',
        'id_tipoDocumento',
        'numeroIdentificacion',
        'ciudadExpedicion',
        'fechaNacimiento',
        'id_nivelEstudio',
        'id_genero',
        'id_ocupacion',
        'id_poblacion',
        'codigo',
        'firma',
        'cargo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameCompletoAttribute()
    {
        // Construir el nombre completo asegurando que los nombres y apellidos opcionales no generen espacios extra
        return trim(
            $this->name . ' ' .
            ($this->nombre_2 ?? '') . ' ' .
            $this->apellido_1 . ' ' .
            ($this->apellido_2 ?? '')
        );
    }

    public function tipoSolicitante()
    {
        return $this->belongsTo(Tsolicitante::class, 'id_tipoSolicitante');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(Tdocumento::class, 'id_tipoDocumento');
    }

    public function nivelEstudio()
    {
        return $this->belongsTo(Nestudio::class, 'id_nivelEstudio');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero');
    }


    public function ocupacion()
    {
        return $this->belongsTo(Ocupacion::class, 'id_ocupacion');
    }

    public function poblacion()
    {
        return $this->belongsTo(Poblacion::class, 'id_poblacion');
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }

    public function solicitudesAvecindamiento()
    {
        return $this->hasMany(SolicitudAvecindamiento::class);
    }

    // Verificar si el usuario tiene un perfil completo
    public function hasCompleteProfile()
    {
        return !empty($this->cargo) && !empty($this->firma);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\CustomVerifyEmail());
    }

}
