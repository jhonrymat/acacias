<?php

namespace App\Livewire;

use App\Models\Barrio;
use Livewire\Component;

class CertificadoResidencia extends Component
{
    public function render()
    {
        $barrios = Barrio::orderBy('nombreBarrio', 'asc')->get();

        return view('livewire.certificado-residencia', [
            'barrios' => $barrios
        ])->layout('components.layouts.bdc');
    }
}
