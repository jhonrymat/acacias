<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'poblacion';

    // Campos asignables
    protected $fillable = ['nombrePoblacion'];

    // Relación con la tabla User
    public function users()
    {
        return $this->hasMany(User::class, 'poblacion_id');
    }
}
