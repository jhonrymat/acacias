<?php

use App\Livewire\RolesComponent;
use App\Livewire\BarrioComponent;
use App\Livewire\GeneroComponent;
use App\Livewire\NestudioComponent;
use App\Livewire\PermisosComponent;
use App\Livewire\UserRoleComponent;
use App\Livewire\OcupacionComponent;
use App\Livewire\PoblacionComponent;
use App\Livewire\SolicitudComponent;
use App\Livewire\FormularioComponent;
use App\Livewire\TdocumentoComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\SolicitudesComponent;
use App\Livewire\TipoSolicitanteComponent;
use App\Livewire\HistorialComponent;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('documento', TdocumentoComponent::class)->name('documento');
Route::get('genero', GeneroComponent::class)->name('genero');
Route::get('nestudio', NestudioComponent::class)->name('nestudio');
Route::get('tsolicitante', TipoSolicitanteComponent::class)->name('tsolicitante');
Route::get('barrio', BarrioComponent::class)->name('barrio');
Route::get('solicitudes', SolicitudComponent::class)->name('solicitudes');
Route::get('roles', RolesComponent::class)->name('roles');
Route::get('permisos', PermisosComponent::class)->name('permisos');
Route::get('formulario', FormularioComponent::class)->name('formulario');
Route::get('ocupacion', OcupacionComponent::class)->name('ocupacion');
Route::get('poblacion', PoblacionComponent::class)->name('poblacion');
Route::get('versolicitudes', SolicitudesComponent::class)->name('versolicitudes');
Route::get('user-roles', UserRoleComponent::class)->name('user-roles');
Route::get('historial', HistorialComponent::class)->name('historial');
