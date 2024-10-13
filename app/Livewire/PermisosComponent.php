<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermisosComponent extends Component
{
    public $name;
    public $permission_id;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function createPermission()
    {
        $this->validate();

        Permission::create(['name' => $this->name]);

        session()->flash('message', 'Permiso creado exitosamente.');
        $this->resetFields();
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $this->permission_id = $permission->id;
        $this->name = $permission->name;
    }

    public function updatePermission()
    {
        $this->validate();

        $permission = Permission::findOrFail($this->permission_id);
        $permission->name = $this->name;
        $permission->save();

        session()->flash('message', 'Permiso actualizado exitosamente.');
        $this->resetFields();
    }

    public function deletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        session()->flash('message', 'Permiso eliminado exitosamente.');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permission_id = null;
    }

    public function render()
    {
        return view('livewire.permisos-component', [
            'permissions' => Permission::all(),
        ]);
    }
}
