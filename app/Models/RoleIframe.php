<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleIframe extends Model
{
    use HasFactory;

    protected $fillable = ['role', 'iframe_title', 'iframe_src', 'attributes'];

    protected $casts = [
        'attributes' => 'array',
    ];
}
