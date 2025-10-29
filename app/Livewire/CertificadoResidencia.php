<?php

namespace App\Livewire;

use Livewire\Component;

class CertificadoResidencia extends Component
{
    public function render()
    {
        return view('livewire.certificado-residencia')
            ->layout('layouts.bdc');
    }
}
