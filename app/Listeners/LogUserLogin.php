<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\AccessLog;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class LogUserLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $currentHour = Carbon::now()->hour;
        $outOfWorkingHours = ($currentHour < 8 || $currentHour > 18); // Ajusta el horario laboral

        AccessLog::create([
            'user_id' => $user->id,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'logged_in_at' => now(),
            'out_of_working_hours' => $outOfWorkingHours,
        ]);
    }
}
