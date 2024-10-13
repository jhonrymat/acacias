<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tsolicitante extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipoSolicitante',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_tipoSolicitante');
    }

}
