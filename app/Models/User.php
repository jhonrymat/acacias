<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
        'id_poblacion'
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

    public function tipoSolicitante()
    {
        return $this->belongsTo(TSolicitante::class, 'id_tipoSolicitante');
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
}
