<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MaintenanceMode;
use Illuminate\Support\Facades\Auth;    
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $maintenance = MaintenanceMode::first();

        if ($maintenance && $maintenance->is_active && (!Auth::check() || !Auth::user()->hasRole('admin'))) {
            abort(503, 'El sistema está en mantenimiento. Intenta más tarde.');
        }

        return $next($request);
    }
}
