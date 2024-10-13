<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleComponent extends Component
{
    public $userId;
    public $roleId;
    public $searchTerm = '';

    protected $rules = [
        'userId' => 'required|exists:users,id',
        'roleId' => 'required|exists:roles,id',
    ];

    public function assignRole()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $role = Role::findOrFail($this->roleId);

        $user->syncRoles([$role]);

        session()->flash('message', "Rol asignado exitosamente a {$user->name}.");

        $this->reset(['userId', 'roleId']);
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->searchTerm . '%')
                     ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
                     ->get();
        $roles = Role::all();

        return view('livewire.user-role-component', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
