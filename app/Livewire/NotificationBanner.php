<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;

class NotificationBanner extends Component
{
    public $position;
    public $isVisible = true; // Controla la visibilidad de la tarjeta solo en la sesión del usuario

    public function mount($position)
    {
        $this->position = $position;
    }

    public function closeBanner()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        $notification = Notification::where('active', true)
            ->whereIn('position', ['both', $this->position])
            ->latest()
            ->first();

        return view('livewire.notification-banner', compact('notification'));
    }
}
