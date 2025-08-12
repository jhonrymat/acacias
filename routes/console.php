<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\UpdateExpiringRequests;

$sch = app(Schedule::class);

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Define las tareas programadas
app(Schedule::class)->call(function () {
    (new UpdateExpiringRequests())->handle();
})->name('update-expiring-requests')->withoutOverlapping();
