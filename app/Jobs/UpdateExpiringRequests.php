<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Solicitud;
use App\Models\SolicitudAvecindamiento;
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

        // === Procesar Solicitudes normales (6 meses de vigencia) ===
        $this->processSolicitudes(Solicitud::class, 6);

        // === Procesar Solicitudes de Avecindamiento (12 meses de vigencia) ===
        $this->processSolicitudes(SolicitudAvecindamiento::class, 12);

        Log::info("Cron Job 'UpdateExpiringRequests' finalizado.");
    }

    private function processSolicitudes(string $modelClass, int $vigenciaMeses)
    {
        // 1. Cambiar a "Por vencer"
        $modelClass::where('estado_id', 5) // Emitido
            ->chunk(100, function ($solicitudes) use ($vigenciaMeses, $modelClass) {
                foreach ($solicitudes as $solicitud) {
                    $fechaVencimiento = Carbon::parse($solicitud->fecha_emision)->addMonths($vigenciaMeses);
                    if (Carbon::now()->greaterThanOrEqualTo($fechaVencimiento->copy()->subDays(15))) {
                        $solicitud->update(['estado_id' => 6]); // Por vencer
                        Log::info(class_basename($modelClass)." ID {$solicitud->id} cambiada a 'Por vencer'.");
                    }
                }
            });

        // 2. Cambiar a "Vencido"
        $modelClass::whereIn('estado_id', [5, 6]) // Emitido o Por vencer
            ->chunk(100, function ($solicitudes) use ($vigenciaMeses, $modelClass) {
                foreach ($solicitudes as $solicitud) {
                    $fechaVencimiento = Carbon::parse($solicitud->fecha_emision)->addMonths($vigenciaMeses);
                    if (Carbon::now()->greaterThanOrEqualTo($fechaVencimiento)) {
                        $solicitud->update(['estado_id' => 7]); // Vencido
                        Log::info(class_basename($modelClass)." ID {$solicitud->id} cambiada a 'Vencido'.");
                    }
                }
            });
    }
}
