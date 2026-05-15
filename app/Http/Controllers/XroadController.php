<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\SolicitudAvecindamiento;
use App\Models\ValidacionAvecindamiento;

class XroadController extends Controller
{
    public function verificarPermisoPaso2()
{
    $userId = Auth::id();

    // Usamos el método existente del modelo
    if (!Solicitud::canCreateRequest($userId)) {
        return response()->json([
            'permitido' => false,
            'titulo' => 'Solicitud activa',
            'mensaje' => 'No puedes crear una nueva solicitud mientras tengas una activa, procesando o pendiente.',
        ]);
    }

    return response()->json(['permitido' => true]);
}
}
