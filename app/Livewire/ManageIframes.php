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

    protected $rules = [
        'role' => 'required|string',
        'iframe_title' => 'required|string',
        'iframe_src' => 'required|url',
    ];

    protected $listeners = ['edit', 'delete'];

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

        RoleIframe::updateOrCreate(
            ['id' => $this->iframe_id],
            ['role' => $this->role, 'iframe_title' => $this->iframe_title, 'iframe_src' => $this->iframe_src]
            
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
    }
    public function render()
    {
        return view('livewire.manage-iframes');
    }
}
