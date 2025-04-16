<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidacionAvecindamiento extends Model
{
    use HasFactory;

    protected $table = 'validaciones_avecindamiento';

    protected $fillable = [
        'validacion1',
        'validacion2',
        'JAComunal',
        'notas',
        'visible',
        'qr_url',
        'solicitud_id'
    ];

    public function solicitud()
    {
        return $this->belongsTo(SolicitudAvecindamiento::class, 'solicitud_id');
    }
}
