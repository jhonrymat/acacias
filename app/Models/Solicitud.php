<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $fillable = [
        'user_id',
        'numeroIdentificacion',
        'id_barrio',
        'direccion',
        'accion_comunal',
        'electoral',
        'sisben',
        'cedula',
        'estado_id',
        'observaciones',
        'terminos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'id_barrio');
    }

    public function validaciones()
    {
        return $this->hasMany(Validacion::class, 'id_solicitud');
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }


    // Método para verificar si el usuario tiene una solicitud pendiente
    public static function hasPendingRequest($userId)
    {
        return self::where('user_id', $userId)
            ->where('estado_id', 1) // Asumiendo que el estado 1 es 'Pendiente'
            ->exists();
    }

    // Método para verificar si el usuario tiene una solicitud aprobada
    public static function hasApprovedRequest($userId)
    {
        return self::where('user_id', $userId)
            ->where('estado_id', 2) // Asumiendo que el estado 2 es 'Aprobada'
            ->exists();
    }

    // Método para verificar si la solicitud aprobada está a punto de expirar (15 días antes de 6 meses)
    public static function isApprovedRequestExpiring($userId)
    {
        $approvedRequest = self::where('user_id', $userId)
            ->where('estado_id', 2) // Estado aprobado
            ->latest('updated_at') // Ordena por la fecha de última actualización (ej. fecha de aprobación)
            ->first();

        if ($approvedRequest) {
            $expiryDate = Carbon::parse($approvedRequest->updated_at)->addMonths(6);
            return Carbon::now()->greaterThanOrEqualTo($expiryDate->subDays(15));
        }

        return false;
    }




}
