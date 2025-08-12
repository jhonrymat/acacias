<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use App\Models\AccessLog;
use Carbon\Carbon;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Login::class => [
            LogUserLogin::class,
        ],
        Logout::class => [
            LogUserLogout::class,
        ],
    ];

    public function boot()
    {
        Event::listen(Login::class, function ($event) {
            $user = $event->user;
            $currentHour = Carbon::now()->hour;

            $outOfWorkingHours = ($currentHour < 8 || $currentHour > 18); // Ajusta el horario laboral

            AccessLog::create([
                'user_id' => $user->id,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'logged_in_at' => now(),
                'out_of_working_hours' => $outOfWorkingHours,
            ]);
        });

        Event::listen(Logout::class, function ($event) {
            AccessLog::where('user_id', $event->user->id)
                ->whereNull('logged_out_at')
                ->latest()
                ->first()
                    ?->update(['logged_out_at' => now()]);
        });
    }
}


