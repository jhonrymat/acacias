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
        'lat' => 'float',
        'lng' => 'float',
    ];
    protected $fillable = [
        'user_id',
        'numeroIdentificacion',
        'id_barrio',
        'direccion',
        'lat',
        'lng',
        'accion_comunal',
        'electoral',
        'sisben',
        'cedula',
        'recibo',
        'estado_id',
        'actualizado_por',
        'Validador2_id',
        'fecha_emision',
        'observaciones',
        'terminos',
        'es_favorito',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // nombre completo de usuario
    public function getNombreCompletoAttribute()
    {
        if (!$this->user) {
            return 'Usuario no asignado'; // Manejo en caso de que no haya usuario
        }

        // Construir el nombre completo asegurando que los nombres y apellidos opcionales no generen espacios extra
        return trim(
            $this->user->name . ' ' .
            ($this->user->nombre_2 ?? '') . ' ' .
            $this->user->apellido_1 . ' ' .
            ($this->user->apellido_2 ?? '')
        );
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

    // public static function hasActiveRequest($userId)
    // {
    //     return self::where('user_id', $userId)
    //         ->whereIn('estado_id', [1, 2, 5, 4]) // Estados restringidos: Pendiente, Procesando, Emitida, en revisión
    //         ->exists();
    // }


    // Método para verificar si la solicitud emitida está a punto de expirar (15 días antes de 6 meses)
    // public static function checkIfExpiring($userId)
    // {
    //     $approvedRequest = self::where('user_id', $userId)
    //         ->where('estado_id', 5) // Emitida
    //         ->latest('fecha_emision')
    //         ->first();


    //     if ($approvedRequest) {
    //         $expiryDate = Carbon::parse($approvedRequest->fecha_emision)->addMonths(6);
    //         return Carbon::now()->greaterThanOrEqualTo($expiryDate->subDays(15));
    //     }

    //     return false;
    // }

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
        $now = now();

        // 1) Bloquea si hay cualquier solicitud en estados NO permitidos: 1, 2, 4
        $hasBlocking = self::where('user_id', $userId)
            ->whereIn('estado_id', [1, 2, 4])
            ->exists();

        if ($hasBlocking) {
            return false;
        }

        // 2) Revisa la última EMITIDA (5)
        $lastEmitted = self::where('user_id', $userId)
            ->where('estado_id', 5) // Emitida
            ->latest('fecha_emision')
            ->first();

        // Si no hay emitida ni bloqueos, puede crear
        if (!$lastEmitted) {
            return true;
        }

        // 3) Con emitida: sólo permitir si ya está en ventana de vencimiento o vencida
        $expiry = Carbon::parse($lastEmitted->fecha_emision)->addMonths(6);
        $windowFrom = $expiry->copy()->subDays(15);

        // Antes de la ventana -> NO puede
        if ($now->lt($windowFrom)) {
            return false;
        }

        // En ventana o vencida -> SÍ puede (solo una, porque al crear quedará en 1/2 y eso bloquea)
        return true;

    }



    public function getNumeroIdentificacionOcultoAttribute()
    {
        $numero = $this->numeroIdentificacion;
        return str_repeat('*', strlen($numero) - 4) . substr($numero, -4);
    }

    public function getVigenciaAttribute()
    {
        if (!$this->fecha_emision) {
            return 'Fecha de emisión no disponible';
        }

        $fechaEmision = Carbon::parse($this->fecha_emision);
        $fechaVencimiento = $fechaEmision->addMonths(6);

        return 'hasta el ' . $fechaVencimiento->format('d/m/Y');
    }

    public function getVigenciaFormateadaAttribute()
    {
        if (!$this->fecha_emision) {
            return 'Fecha de emisión no disponible';
        }

        $fechaEmision = Carbon::parse($this->fecha_emision);
        $fechaVencimiento = $fechaEmision->addMonths(6);

        return 'hasta el ' . $fechaVencimiento->translatedFormat('d \\de F \\de Y');
    }


    public function getFechaEmisionFormateadaAttribute()
    {
        return $this->fecha_emision ? Carbon::parse($this->fecha_emision)->format('d/m/Y') : 'N/A';
    }



}
