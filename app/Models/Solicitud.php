<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $casts = [
        'fecha_emision' => 'date',
    ];
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
        'actualizado_por',
        'Validador2_id',
        'fecha_emision',
        'observaciones',
        'terminos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function validador2()
    {
        return $this->belongsTo(User::class, 'Validador2_id');
    }

    // Relación con el usuario que actualizó
    public function actualizador()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
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
    public static function hasActiveRequest($userId)
    {
        return self::where('user_id', $userId)
            ->whereIn('estado_id', [1, 2, 5]) // Estados restringidos: Pendiente, Aprobada, Emitida
            ->exists();
    }


    // Método para verificar si la solicitud aprobada está a punto de expirar (15 días antes de 6 meses)
    public static function checkIfExpiring($userId)
    {
        $approvedRequest = self::where('user_id', $userId)
            ->where('estado_id', 5) // Emitida
            ->latest('fecha_emision')
            ->first();

        if ($approvedRequest) {
            $expiryDate = Carbon::parse($approvedRequest->fecha_emision)->addMonths(6);
            return Carbon::now()->greaterThanOrEqualTo($expiryDate->subDays(15));
        }

        return false;
    }

    public static function updateToExpiring($userId)
    {
        $approvedRequest = self::where('user_id', $userId)
            ->where('estado_id', 5) // Emitida
            ->latest('fecha_emision')
            ->first();

        if ($approvedRequest && self::checkIfExpiring($userId)) {
            $approvedRequest->update(['estado_id' => 6]); // Por vencer
            return true;
        }

        return false;
    }

    public static function canCreateRequest($userId)
    {
        // Verificar si el usuario tiene una solicitud activa
        $hasActiveRequest = self::hasActiveRequest($userId);

        // Verificar si alguna solicitud está por vencer
        $isExpiring = self::checkIfExpiring($userId);

        // Permitir crear una nueva solicitud si:
        // - No tiene solicitudes activas
        // - O tiene una solicitud emitida que está por vencer
        return !$hasActiveRequest || $isExpiring;
    }



}
