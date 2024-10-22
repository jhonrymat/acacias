<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';
    protected $fillable = ['nombreEstado', 'descripcion', 'color'];

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'estado_id');
    }
}
