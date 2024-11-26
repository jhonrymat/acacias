<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises'; 
    use HasFactory;

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
}
