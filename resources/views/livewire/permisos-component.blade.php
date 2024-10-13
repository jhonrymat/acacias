<div>
    <h1>Gestión de Permisos</h1>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="createPermission">
        <input type="text" wire:model="name" placeholder="Nombre del permiso">
        <button type="submit">Crear Permiso</button>
    </form>

    <ul>
        @foreach($permissions as $permission)
            <li>{{ $permission->name }}
                <button wire:click="editPermission({{ $permission->id }})">Editar</button>
                <button wire:click="deletePermission({{ $permission->id }})">Eliminar</button>
            </li>
        @endforeach
    </ul>
</div>
