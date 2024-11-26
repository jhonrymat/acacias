<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateExpiringRequests implements ShouldQueue
{

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Cron Job 'UpdateExpiringRequests' iniciado.");

        // 1. Cambiar solicitudes a "Por vencer"
        Solicitud::where('estado_id', 5) // Emitido
            ->chunk(100, function ($solicitudes) {
                foreach ($solicitudes as $solicitud) {
                    $fechaVencimiento = Carbon::parse($solicitud->fecha_emision)->addMonths(6);
                    if (Carbon::now()->greaterThanOrEqualTo($fechaVencimiento->subDays(15))) {
                        $solicitud->update(['estado_id' => 6]); // Por vencer
                        Log::info("Solicitud {$solicitud->id} cambiada a 'Por vencer'.");
                    }
                }
            });

        // 2. Cambiar solicitudes a "Vencido"
        Solicitud::whereIn('estado_id', [5, 6]) // Emitido o Por vencer
            ->chunk(100, function ($solicitudes) {
                foreach ($solicitudes as $solicitud) {
                    $fechaVencimiento = Carbon::parse($solicitud->fecha_emision)->addDays(60);
                    if (Carbon::now()->greaterThanOrEqualTo($fechaVencimiento)) {
                        $solicitud->update(['estado_id' => 7]); // Vencido
                        Log::info("Solicitud {$solicitud->id} cambiada a 'Vencido'.");
                    }
                }
            });

        Log::info("Cron Job 'UpdateExpiringRequests' finalizado.");
    }
}
