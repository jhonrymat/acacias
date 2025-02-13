<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RoleIframe;

class ManageIframes extends Component
{
    public $iframes = [];
    public $role;
    public $iframe_title;
    public $iframe_src;
    public $iframe_id;
    public $iframe_attributes = []; // Nuevo campo para atributos JSON

    protected $rules = [
        'role' => 'required|string',
        'iframe_title' => 'required|string',
        'iframe_src' => 'required|url',
    ];

    protected $listeners = ['edit', 'delete', 'formatAttributes'];

    public function mount()
    {
        $this->loadIframes();
    }

    public function loadIframes()
    {
        $this->iframes = RoleIframe::all();
    }

    public function save()
    {
        $this->validate();

        // Convertir array de ['key' => 'valor'] a formato asociativo JSON
        $attributesArray = [];
        foreach ($this->iframe_attributes as $attr) {
            if (!empty($attr['key']) && !empty($attr['value'])) {
                $attributesArray[$attr['key']] = $attr['value'];
            }
        }

        RoleIframe::updateOrCreate(
            ['id' => $this->iframe_id],
            [
                'role' => $this->role,
                'iframe_title' => $this->iframe_title,
                'iframe_src' => $this->iframe_src,
                'attributes' => json_encode($attributesArray), // Guardar los atributos dinámicos
            ]
        );

        $this->resetForm();
        $this->loadIframes();
        $this->dispatch('Updated');
        session()->flash('message', 'Iframe guardado exitosamente.');
    }

    public function edit($Id)
    {
        $iframe = RoleIframe::findOrFail($Id);
        $this->iframe_id = $iframe->id;
        $this->role = $iframe->role;
        $this->iframe_title = $iframe->iframe_title;
        $this->iframe_src = $iframe->iframe_src;

        // Decodificar los atributos y transformarlos en el formato adecuado
        $attributes = json_decode($iframe->attributes, true) ?? [];

        $this->iframe_attributes = collect($attributes)
            ->map(fn($value, $key) => ['key' => $key, 'value' => $value])
            ->values()
            ->toArray();
    }


    public function delete($Id)
    {
        RoleIframe::findOrFail($Id)->delete();
        $this->loadIframes();
        $this->dispatch('Updated');
        session()->flash('message', 'Iframe eliminado exitosamente.');
    }

    public function resetForm()
    {
        $this->iframe_id = null;
        $this->role = '';
        $this->iframe_title = '';
        $this->iframe_src = '';
        $this->iframe_attributes = [];
    }

    public function addAttribute()
    {
        $this->iframe_attributes[] = ['key' => '', 'value' => ''];
    }

    public function removeAttribute($index)
    {
        unset($this->iframe_attributes[$index]);
        $this->iframe_attributes = array_values($this->iframe_attributes); // Reindexar
    }

    public function render()
    {
        return view('livewire.manage-iframes');
    }
}
