<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\MaintenanceMode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Notifications\MaintenanceModeActivated;
use Illuminate\Support\Facades\Notification;

class MaintenanceToggle extends Component
{
    public $isMaintenanceOn;
    public $secretUrl;

    public function mount()
    {
        $maintenance = MaintenanceMode::first();
        $this->isMaintenanceOn = $maintenance?->is_active ?? false;
        $this->secretUrl = $maintenance?->secret_url ?? null;
    }

    public function toggleMaintenance()
    {
        $this->isMaintenanceOn = !$this->isMaintenanceOn;

        if ($this->isMaintenanceOn) {
            $secret = Str::random(32);
            Artisan::call('down', ['--secret' => $secret]);

            MaintenanceMode::updateOrCreate(
                ['id' => 1],
                [
                    'is_active' => true,
                    'activated_by' => Auth::user()->name,
                    'secret_url' => $secret
                ]
            );

            $this->secretUrl = url($secret);

            // Enviar el correo a los administradores
            $admins = User::role('admin')->get();
            Notification::send($admins, new MaintenanceModeActivated($this->secretUrl));
        } else {
            Artisan::call('up');

            MaintenanceMode::updateOrCreate(
                ['id' => 1],
                [
                    'is_active' => false,
                    'activated_by' => Auth::user()->name,
                    'secret_url' => null
                ]
            );

            $this->secretUrl = null;
        }

        session()->flash('message', $this->isMaintenanceOn ? 'Modo de mantenimiento activado.' : 'Modo de mantenimiento desactivado.');
    }

    public function render()
    {
        return view('livewire.maintenance-toggle');
    }
}
