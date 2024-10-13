<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_solicitud', 'fechaValidacion', 'validacionSalud',
        'evidenciaSalud', 'validacionElecciones', 'evidenciaElecciones',
        'validacionJuntas', 'evidenciaJuntas'
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitud');
    }
}
