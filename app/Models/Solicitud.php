<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $fillable = [
        'user_id',
        'numeroIdentificacion',
        'id_barrio',
        'direccion',
        'evidenciaPDF',
        'observaciones',
        'terminos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'id_barrio');
    }

    public function validaciones()
    {
        return $this->hasMany(Validacion::class, 'id_solicitud');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion');
    }





}
