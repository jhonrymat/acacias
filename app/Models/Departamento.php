<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    use HasFactory;

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }
}
