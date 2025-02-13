<?php
namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesComponent extends Component
{
    public $name;
    public $role_id;
    public $permissionIds = [];
    public $isEditing = false;
    public $selectedRole;
    public $showRoleDetails = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'permissionIds' => 'array',
    ];

    protected $listeners = ['showRoleDetails'];

    public function createOrUpdateRole()
    {
        $this->validate();

        if ($this->isEditing) {
            $role = Role::findOrFail($this->role_id);
            $role->name = $this->name;
            $role->save();
        } else {
            $role = Role::create([
                'name' => $this->name,
                'guard_name' => 'web',
            ]);
        }

        $permissions = Permission::whereIn('id', $this->permissionIds)->get();
        $role->syncPermissions($permissions);

        session()->flash('message', $this->isEditing ? 'Rol actualizado exitosamente.' : 'Rol creado exitosamente.');
        $this->resetFields();
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->permissionIds = $role->permissions->pluck('id')->toArray();
        $this->isEditing = true;
        $this->showRoleDetails = false;
    }

    public function showRoleDetails($Id)
    {
        $this->selectedRole = Role::with('permissions')->findOrFail($Id);
        $this->showRoleDetails = true;
        $this->isEditing = false;
    }

    public function hideRoleDetails()
    {
        $this->showRoleDetails = false;
        $this->selectedRole = null;
    }

    public function cancelEdit()
    {
        $this->resetFields();
    }

    public function deleteRole($id)
    {
        Role::findOrFail($id)->delete();
        session()->flash('message', 'Rol eliminado exitosamente.');
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permissionIds = [];
        $this->role_id = null;
        $this->isEditing = false;
        $this->showRoleDetails = false;
        $this->selectedRole = null;
    }

    public function render()
    {
        $roles = Role::all();
        $allPermissions = Permission::all();

        return view('livewire.roles-component', [
            'roles' => $roles,
            'allPermissions' => $allPermissions,
        ]);
    }
}
