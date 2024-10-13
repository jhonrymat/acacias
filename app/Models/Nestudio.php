<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nestudio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nivelEstudio',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_nivelEstudio');
    }



}
