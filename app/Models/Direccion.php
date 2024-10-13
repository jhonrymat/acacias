<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'tipoViaPrimaria',
        'numeroViaPrincipal',
        'letraViaPrincipal',
        'bis',
        'letraBis',
        'cuadranteViaPrincipal',
        'numeroViaGeneradora',
        'letraViaGeneradora',
        'numeroPlaca',
        'cuadranteViaGeneradora',
        'barrio_id' // Clave foránea relacionada con Barrios
    ];

    // Relación con la tabla Barrio
    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id');
    }

    // Relación con la tabla Solicitudes si aplica (uno a uno)
    public function solicitud()
    {
        return $this->hasOne(Solicitud::class);
    }

}
