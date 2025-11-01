<?php

use Milon\Barcode\DNS2D;
use App\Models\Solicitud;
use App\Models\RoleIframe;
use App\Models\Validacion;
use App\Livewire\AccessLog;
use App\Livewire\AyudaPost;
use App\Livewire\ValidarQr;
use App\Livewire\ActivityLog;
use App\Livewire\SiteSettings;
use App\Livewire\ManageIframes;
use App\Livewire\TipoSolicitud;
use App\Livewire\RolesComponent;
use App\Livewire\BarrioComponent;
use App\Livewire\ConsultaTramite;
use App\Livewire\GeneroComponent;
use App\Livewire\MaintenanceToggle;
use App\Livewire\NestudioComponent;
use App\Livewire\PermisosComponent;
use App\Livewire\UserRoleComponent;
use App\Livewire\AdminNotifications;
use App\Livewire\HistorialComponent;
use App\Livewire\OcupacionComponent;
use App\Livewire\PoblacionComponent;
use App\Livewire\SolicitudComponent;
use App\Livewire\CiudadanosComponent;
use App\Livewire\FormularioComponent;
use App\Livewire\TdocumentoComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\CertificadoComponent;
use App\Livewire\SolicitudesComponent;
use App\Livewire\ValidadoresComponent;
use App\Http\Controllers\PDFController;
use App\Livewire\CertificadoResidencia;
use App\Livewire\EstadisticasValidador;
use App\Http\Controllers\XroadController;
use App\Livewire\ValidarQrAvecindamiento;
use App\Livewire\TipoSolicitanteComponent;
use App\Livewire\SolicitudesExportComponent;
use App\Livewire\SolicitudAnulacionComponent;
use App\Livewire\HistorialAvecindamientoComponent;
use App\Livewire\SolicitudAvecindamientoComponent;
use App\Livewire\FormularioAvecindamientoComponent;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Livewire\SolicitudesAvecindamientoComponent;
use App\Livewire\SolicitudAnulacionAvecindamientoComponent;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/consulta-tramite', ConsultaTramite::class)->name('consulta.tramite');
Route::get('/qr/{id}/{numeroIdentificacion}', ValidarQr::class)->name('validar.qr');
Route::get('/qr-avecindamiento/{id}/{numeroIdentificacion}', ValidarQrAvecindamiento::class)->name('validar.qr.avecindamiento');

Route::middleware(['auth', 'can:permisos'])->group(function () {
    Route::get('admin/maintenance', MaintenanceToggle::class)->name('maintenance.toggle');
});

// ruta para xroad nueva vista para los usuarios
Route::get('/certificado-residencia', CertificadoResidencia::class)
    ->name('certificado.residencia');



// fin ruta para xroad nueva vista para los usuarios


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::middleware(['can:documento'])->get('documento', TdocumentoComponent::class)->name('documento');
    Route::middleware(['can:genero'])->get('genero', GeneroComponent::class)->name('genero');
    Route::middleware(['can:nestudio'])->get('nestudio', NestudioComponent::class)->name('nestudio');
    Route::middleware(['can:tsolicitante'])->get('tsolicitante', TipoSolicitanteComponent::class)->name('tsolicitante');
    Route::middleware(['can:barrio'])->get('barrio', BarrioComponent::class)->name('barrio');
    Route::middleware(['can:solicitudes'])->get('solicitudes-residencia', SolicitudComponent::class)->name('solicitudes-residencia');
    Route::middleware(['can:solicitudes'])->get('solicitudes-avecindamiento', SolicitudAvecindamientoComponent::class)->name('solicitudes-avecindamiento');
    Route::middleware(['can:roles'])->get('roles', RolesComponent::class)->name('roles');
    Route::middleware(['can:permisos'])->get('permisos', PermisosComponent::class)->name('permisos');
    Route::middleware(['can:formulario'])->get('formulario-residencia', FormularioComponent::class)->name('formulario-residencia');
    Route::middleware(['can:formulario'])->get('formulario-avecindamiento', FormularioAvecindamientoComponent::class)->name('formulario-avecindamiento');
    Route::middleware(['can:ocupacion'])->get('ocupacion', OcupacionComponent::class)->name('ocupacion');
    Route::middleware(['can:poblacion'])->get('poblacion', PoblacionComponent::class)->name('poblacion');
    Route::middleware(['can:versolicitudes'])->get('versolicitudesresidencia', SolicitudesComponent::class)->name('versolicitudesresidencia');
    Route::middleware(['can:versolicitudes'])->get('versolicitudesavecindamiento', SolicitudesAvecindamientoComponent::class)->name('versolicitudesavecindamiento');
    Route::middleware(['can:user-roles'])->get('user-roles', UserRoleComponent::class)->name('user-roles');
    Route::middleware(['can:historial'])->get('historial-residencia', HistorialComponent::class)->name('historial-residencia');
    Route::middleware(['can:historial'])->get('historial-avecindamiento', HistorialAvecindamientoComponent::class)->name('historial-avecindamiento');
    // ruta para obtener todos los ciudadanos de la base de datos
    Route::middleware(['can:ciudadanos'])->get('ciudadanos', CiudadanosComponent::class)->name('ciudadanos');
    Route::middleware(['can:validadores'])->get('validadores', ValidadoresComponent::class)->name('validadores');

    // Anular solicitudes ya omitidas
    // Route::middleware(['can:permisos'])->get('anular-solicitud', SolicitudAnulacionComponent::class)->name('anular-solicitud');
    Route::middleware(['role:validador2'])->get('anular-solicitud-residencia', SolicitudAnulacionComponent::class)->name('anular-solicitud-residencia');
    Route::middleware(['role:validador2'])->get('anular-solicitud-avecindamiento', SolicitudAnulacionAvecindamientoComponent::class)->name('anular-solicitud-avecindamiento');

    // modulo para exportar solicitudes
    Route::middleware(['role:validador2'])->get('exportar-solicitudes', SolicitudesExportComponent::class)->name('exportar-solicitudes');

    Route::get('certificados', CertificadoComponent::class)->name('certificados');
    //ruta para la politica de proteccion de datos
    Route::get('proteccion', function () {
        return view('pages/politicas-proteccion-datos');
    })->name('proteccion');
    Route::get('certificado', function () {
        return view('certificados.certificado');
    })->name('certificado');
    // ruta para las estadisticas
    Route::get('estadisticas1', EstadisticasValidador::class)->name('estadisticas1');



    Route::get('/solicitud/pdf/{id}', [PDFController::class, 'verPDF'])->name('solicitud.verPDF');
    Route::get('/solicitudAvecindamiento/pdf/{id}', [PDFController::class, 'verPDFAvecindamiento'])->name('solicitud.verPDF.avecindamiento');

    // tablas
    Route::middleware(['can:permisos'])->get('historial-accesos', AccessLog::class)->name('historial.accesos');
    Route::middleware(['can:permisos'])->get('historial-actividades', ActivityLog::class)->name('historial.actividades');

    //notificaciones
    Route::middleware(['can:permisos'])->get('notifications', AdminNotifications::class)->name('admin.notifications');

    Route::middleware(['can:iframe'])->get('iframes', ManageIframes::class)->name('iframes');

    //<livewire:site-settings />
    Route::middleware(['can:roles'])->get('administracion', SiteSettings::class)->name('administracion');

    // ayuda
    Route::get('ayuda', AyudaPost::class)->name('ayuda');

    Route::middleware(['can:user-roles'])->get('fix-qr', function () {
        echo "Iniciando generación de QR...<br>";

        try {
            $solicitudes = Solicitud::where('estado_id', 5)
                ->whereHas('validaciones', function ($query) {
                    $query->whereNull('qr_url')->orWhere('qr_url', '');
                })
                ->get();

            if ($solicitudes->isEmpty()) {
                echo "No hay solicitudes pendientes de QR.<br>";
                return;
            }

            foreach ($solicitudes as $solicitud) {
                echo "Procesando solicitud ID: {$solicitud->id}...<br>";

                $qrUrl = config('app.url') . '/qr/' . $solicitud->id . '/' . $solicitud->numeroIdentificacion;
                $qrPath = 'qrs/' . $solicitud->id . '.png';
                $qrFullPath = storage_path('app/public/' . $qrPath);

                // Crear directorio si no existe
                $qrStoragePath = storage_path('app/public/qrs');
                if (!is_dir($qrStoragePath)) {
                    mkdir($qrStoragePath, 0755, true);
                }

                // Generar QR
                $barcode = new DNS2D();
                $qrImageContent = $barcode->getBarcodePNG($qrUrl, 'QRCODE', 10, 10);

                if (!$qrImageContent) {
                    echo "Error: No se pudo generar el QR para la solicitud ID: {$solicitud->id}<br>";
                    continue;
                }

                file_put_contents($qrFullPath, base64_decode($qrImageContent));

                if (!file_exists($qrFullPath)) {
                    echo "Error: No se pudo guardar el código QR en {$qrFullPath}<br>";
                    continue;
                }

                // Crear o actualizar la validación
                $validacion = Validacion::firstOrCreate(
                    ['id_solicitud' => $solicitud->id],
                    ['qr_url' => $qrPath]
                );
                $validacion->update(['qr_url' => $qrPath]);

                echo "✅ QR generado correctamente para solicitud ID: {$solicitud->id}<br>";
            }
        } catch (\Exception $e) {
            echo "❌ Error crítico: " . $e->getMessage() . "<br>";
        }
    });


});



/*
|--------------------------------------------------------------------------
| Rutas Públicas - Certificado de Residencia
|--------------------------------------------------------------------------
*/

// Ruta principal del certificado (puede ser accesible para todos o solo autenticados)
Route::get('/certificado-residencia', CertificadoResidencia::class)
    ->name('certificado.residencia');

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación Personalizadas (AJAX)
|--------------------------------------------------------------------------
| Estas rutas NO redireccionan, solo retornan JSON
*/
Route::prefix('certificado-residencia')->group(function () {
    //

    Route::middleware('guest')->group(function () {
        Route::post('/auth/login', [CustomLoginController::class, 'login'])
            ->name('certificado.auth.login');

        // Route::post('/auth/register', [CustomLoginController::class, 'register'])
        //     ->name('certificado.auth.register');

        Route::post('/password/email', [CustomLoginController::class, 'sendResetLink'])
            ->name('certificado.password.email');

        // Mostrar formulario de restablecimiento
        Route::get('/reset-password/{token}', [CustomLoginController::class, 'showResetForm'])
            ->name('certificado.password.reset');

        Route::post('/password/reset', [CustomLoginController::class, 'resetPassword'])
            ->name('certificado.password.update');
    });

    Route::middleware('auth')->group(function () {
        // Logout AJAX - Nombre único
        Route::post('/auth/logout', [CustomLoginController::class, 'logout'])
            ->name('certificado.auth.logout');

        // Verificar estado de autenticación (útil para validar sesión)
        Route::get('/auth/check', function () {
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ]
            ]);
        })->name('certificado.auth.check');
    });
});


Route::get('/estado-login', function () {
    return view('components.xroad.paso1')->render();
});

Route::get('/verificar-permiso-paso2', [XroadController::class, 'verificarPermisoPaso2'])
    ->name('verificarPermisoPaso2')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| NOTA: Las rutas de Jetstream siguen funcionando normalmente
|--------------------------------------------------------------------------
| Route::get('/login') - Login tradicional de Jetstream
| Route::post('/login') - Post de Jetstream
| Estas NO interfieren con tus rutas personalizadas
*/
