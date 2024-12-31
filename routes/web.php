<?php

use App\Livewire\EstadisticasValidador;
use App\Livewire\ValidarQr;
use App\Livewire\RolesComponent;
use App\Livewire\BarrioComponent;
use App\Livewire\ConsultaTramite;
use App\Livewire\GeneroComponent;
use App\Livewire\NestudioComponent;
use App\Livewire\PermisosComponent;
use App\Livewire\UserRoleComponent;
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
use App\Livewire\TipoSolicitanteComponent;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/consulta-tramite', ConsultaTramite::class)->name('consulta.tramite');
Route::get('/qr/{id}/{numeroIdentificacion}', ValidarQr::class)->name('validar.qr');

Route::get('estadisticas', function () {
    return view('pages/estadisticas');
})->name('estadisticas');



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
    Route::middleware(['can:solicitudes'])->get('solicitudes', SolicitudComponent::class)->name('solicitudes');
    Route::middleware(['can:roles'])->get('roles', RolesComponent::class)->name('roles');
    Route::middleware(['can:permisos'])->get('permisos', PermisosComponent::class)->name('permisos');
    Route::middleware(['can:formulario'])->get('formulario', FormularioComponent::class)->name('formulario');
    Route::middleware(['can:ocupacion'])->get('ocupacion', OcupacionComponent::class)->name('ocupacion');
    Route::middleware(['can:poblacion'])->get('poblacion', PoblacionComponent::class)->name('poblacion');
    Route::middleware(['can:versolicitudes'])->get('versolicitudes', SolicitudesComponent::class)->name('versolicitudes');
    Route::middleware(['can:user-roles'])->get('user-roles', UserRoleComponent::class)->name('user-roles');
    Route::middleware(['can:historial'])->get('historial', HistorialComponent::class)->name('historial');
    // ruta para obtener todos los ciudadanos de la base de datos
    Route::middleware(['can:ciudadanos'])->get('ciudadanos', CiudadanosComponent::class)->name('ciudadanos');
    Route::middleware(['can:validadores'])->get('validadores', ValidadoresComponent::class)->name('validadores');
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
});


// comado para crea cpmponete de livewire
// php artisan make:livewire EstadisticasValidador
