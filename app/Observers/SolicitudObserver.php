<?php

namespace App\Observers;

use App\Models\Solicitud;
use App\Helpers\ActivityLogger;
use Illuminate\Support\Facades\Auth;

class SolicitudObserver
{

    /**
     * Se ejecuta cuando se crea una solicitud.
     */
    public function created(Solicitud $solicitud)
    {
        ActivityLogger::log('Creó una solicitud', $solicitud);
    }

    /**
     * Se ejecuta cuando se actualiza una solicitud.
     */
    public function updated(Solicitud $solicitud)
    {
        ActivityLogger::log('Actualizó una solicitud', $solicitud, $solicitud->getChanges());
    }

    /**
     * Se ejecuta cuando se elimina una solicitud.
     */
    public function deleted(Solicitud $solicitud)
    {
        ActivityLogger::log('Eliminó una solicitud', $solicitud);
    }

    /**
     * Handle the Solicitud "force deleted" event.
     */
    public function forceDeleted(Solicitud $solicitud): void
    {
        //
    }
}
