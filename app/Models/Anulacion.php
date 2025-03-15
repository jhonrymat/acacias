<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anulacion extends Model
{
    use HasFactory;

    // definir la tabla de la base de datos
    protected $table = 'anulaciones';

    protected $fillable = ['solicitud_id', 'usuario_id', 'descripcion', 'archivo', 'visible'];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
