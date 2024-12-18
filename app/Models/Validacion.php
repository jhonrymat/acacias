<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{
    protected $table = 'validaciones';
    use HasFactory;
    protected $fillable = [
        'validacion1',
        'validacion2',
        'JAComunal',
        'notas',
        'visible',
        'qr_url'
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitud');
    }
}
