<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;

class AdminNotifications extends Component
{
    public $title, $message, $color = 'blue', $active = true;
    public $position = 'both';
    public $editingId;

    public function save()
    {
        Notification::updateOrCreate(
            ['id' => $this->editingId],
            [
                'title' => $this->title,
                'message' => $this->message,
                'color' => $this->color,
                'active' => $this->active ? 1 : 0,
                'position' => $this->position,
            ]
        );

        $this->reset();
        session()->flash('message', 'Notificación guardada correctamente.');
    }

    public function edit($id)
    {
        $notif = Notification::findOrFail($id);
        $this->editingId = $notif->id;
        $this->title = $notif->title;
        $this->message = $notif->message;
        $this->color = $notif->color;
        $this->active = (bool) $notif->active; // Convierte el valor a booleano
        $this->position = $notif->position;
    }

    public function delete($id)
    {
        Notification::destroy($id);
    }

    public function render()
    {
        return view('livewire.admin-notifications', [
            'notifications' => Notification::latest()->get()
        ]);
    }
}
