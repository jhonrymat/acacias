<?php

namespace App\Livewire;

use App\Models\Direccion;
use App\Models\Barrio; // Relación con barrios
use Livewire\Component;

class DireccionComponent extends Component
{
   
    public $tipoViaPrimaria, $numeroViaPrincipal, $letraViaPrincipal, $bis, $letraBis, $cuadranteViaPrincipal;
    public $numeroViaGeneradora, $letraViaGeneradora, $numeroPlaca, $cuadranteViaGeneradora;
    public $barrio_id; // Selección del barrio
    public $direccionCompleta; // Para mostrar la dirección completa generada
    public $showForm = false; // Control del modal

    protected $rules = [
        'tipoViaPrimaria' => 'required|string|max:10',
        'numeroViaPrincipal' => 'required|string|max:10',
        'letraViaPrincipal' => 'nullable|string|max:2',
        'bis' => 'nullable|string|max:3',
        'letraBis' => 'nullable|string|max:2',
        'cuadranteViaPrincipal' => 'nullable|string|max:4',
        'numeroViaGeneradora' => 'nullable|string|max:10',
        'letraViaGeneradora' => 'nullable|string|max:2',
        'numeroPlaca' => 'required|string|max:10',
        'cuadranteViaGeneradora' => 'nullable|string|max:4',
        'barrio_id' => 'required|exists:barrios,id'
    ];

    public function save()
    {
        $this->validate();

        Direccion::create([
            'tipoViaPrimaria' => $this->tipoViaPrimaria,
            'numeroViaPrincipal' => $this->numeroViaPrincipal,
            'letraViaPrincipal' => $this->letraViaPrincipal,
            'bis' => $this->bis,
            'letraBis' => $this->letraBis,
            'cuadranteViaPrincipal' => $this->cuadranteViaPrincipal,
            'numeroViaGeneradora' => $this->numeroViaGeneradora,
            'letraViaGeneradora' => $this->letraViaGeneradora,
            'numeroPlaca' => $this->numeroPlaca,
            'cuadranteViaGeneradora' => $this->cuadranteViaGeneradora,
            'barrio_id' => $this->barrio_id
        ]);

        $this->resetForm();
        $this->dispatch('direccionSaved'); // Evento para notificar que se guardó la dirección
    }

    public function resetForm()
    {
        $this->tipoViaPrimaria = '';
        $this->numeroViaPrincipal = '';
        $this->letraViaPrincipal = '';
        $this->bis = '';
        $this->letraBis = '';
        $this->cuadranteViaPrincipal = '';
        $this->numeroViaGeneradora = '';
        $this->letraViaGeneradora = '';
        $this->numeroPlaca = '';
        $this->cuadranteViaGeneradora = '';
        $this->barrio_id = '';
    }

    public function generateDireccionCompleta()
    {
        $this->direccionCompleta = "{$this->tipoViaPrimaria} {$this->numeroViaPrincipal} {$this->letraViaPrincipal} {$this->bis} {$this->letraBis} {$this->cuadranteViaPrincipal} No. {$this->numeroViaGeneradora} {$this->letraViaGeneradora} - {$this->numeroPlaca} {$this->cuadranteViaGeneradora}";
    }

    public function render()
    {
        return view('livewire.direccion-component', [
            'barrios' => Barrio::all() // Obtener todos los barrios para el select
        ]);
    }
}
