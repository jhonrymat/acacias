<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;
    protected $table = 'barrios';

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];

    protected $fillable = ['nombreBarrio', 'tipoUnidad', 'codigoNumero', 'zona', 'lat', 'lng'];


    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_barrio');
    }


}
