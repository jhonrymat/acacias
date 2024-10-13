<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocupacion extends Model
{
    use HasFactory;

    // Definimos la tabla asociada
    protected $table = 'ocupacion';

    // Definimos los campos que se pueden asignar masivamente
    protected $fillable = ['nombreOcupacion'];

    public function user()
    {
        return $this->hasMany(User::class, 'id_ocupacion');
    }
}
