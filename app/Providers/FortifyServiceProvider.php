<?php

namespace App\Providers;

use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Genero;
use App\Models\Nestudio;
use App\Models\Ocupacion;
use App\Models\Poblacion;
use App\Models\Tdocumento;
use Illuminate\Support\Str;
use App\Models\Departamento;
use App\Models\Tsolicitante;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::registerView(function () {
            return view('auth.register', [
                'tsolicitantes' => Tsolicitante::all(), // Pasar los barrios a la vista
                'tdocumentos' => Tdocumento::all(), // Pasar los barrios a la vista
                'nestudios' => Nestudio::all(), // Pasar los barrios a la vista
                'generos' => Genero::all(), // Pasar los barrios a la vista
                'ocupaciones' => Ocupacion::all()->sortBy('nombreOcupacion'), // Pasar los barrios a la vista en orden alfabético
                'poblaciones' => Poblacion::all()->sortBy('nombrePoblacion'), // Pasar los barrios a la vista en orden alfabético
                // pasar los pais a la vista en orden alfabético
                'paises' => Pais::all()->sortBy('nombre')->values()->toArray(),
                'departamentos' => Departamento::all()->sortBy('nombre')->values()->toArray(),
                'ciudades' => Ciudad::all()->sortBy('nombre')->values()->toArray(),
            ]);
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
