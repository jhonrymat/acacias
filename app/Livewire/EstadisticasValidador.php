<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoleIframe;

class EstadisticasValidador extends Component
{
    public $iframes = [];

    public function mount()
    {
        $this->loadIframes();
    }

    public function loadIframes()
    {
        // Obtén el rol del usuario autenticado
        $userRole = auth()->user()->getRoleNames()->first();

        // Carga los iframes relacionados con ese rol
        $this->iframes = RoleIframe::where('role', $userRole)->get();
    }

    public function render()
    {
        return view('livewire.estadisticas-validador');
    }
}
