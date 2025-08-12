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
        $now = now();
        $expiryThreshold = $now->clone()->subMonths($vigenciaMeses);
        $windowThreshold = $now->clone()->addDays(15)->subMonths($vigenciaMeses);

        // 1) Vencidos (7): 5 o 6 con fecha_emision <= expiry
        $vencidos = $modelClass::whereIn('estado_id', [5, 6])
            ->whereNotNull('fecha_emision')
            ->where('fecha_emision', '<=', $expiryThreshold)   // sin whereDate
            ->update(['estado_id' => 7, 'updated_at' => now()]);
        Log::info(class_basename($modelClass) . " → Vencidos actualizados: {$vencidos}");

        // 2) Por vencer (6): 5 con fecha_emision en ventana (<= window) y > expiry (no vencidos)
        $porVencer = $modelClass::where('estado_id', 5)
            ->whereNotNull('fecha_emision')
            ->where('fecha_emision', '>', $expiryThreshold)
            ->where('fecha_emision', '<=', $windowThreshold)
            ->update(['estado_id' => 6, 'updated_at' => now()]);
        Log::info(class_basename($modelClass) . " → Por vencer actualizados: {$porVencer}");
    }


}
