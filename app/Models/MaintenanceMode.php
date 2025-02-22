<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceMode extends Model
{
    protected $table = 'maintenance_mode';
    protected $fillable = ['is_active', 'activated_by', 'secret_url'];
}
