<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Asignación de Roles a Usuarios</h1>
    
    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <label for="searchTerm" class="block text-sm font-medium text-gray-700">Buscar Usuario</label>
        <input type="text" id="searchTerm" wire:model.debounce.300ms="searchTerm" placeholder="Nombre o email del usuario"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>

    <form wire:submit.prevent="assignRole" class="mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
            <div>
                <label for="userId" class="block text-sm font-medium text-gray-700">Usuario</label>
                <select id="userId" wire:model="userId"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Seleccionar Usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="roleId" class="block text-sm font-medium text-gray-700">Nuevo Rol</label>
                <select id="roleId" wire:model="roleId"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Seleccionar Rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Asignar Rol
                </button>
            </div>
        </div>
    </form>

    <h2 class="text-xl font-semibold mb-4">Usuarios y sus Roles Actuales</h2>
    <ul class="bg-gray-50 rounded-lg shadow-sm p-4 divide-y divide-gray-200">
        @foreach ($users as $user)
            <li class="py-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-700 font-medium">{{ $user->name }} ({{ $user->email }})</span>
                    <span class="text-gray-500">
                        Roles: {{ $user->roles->pluck('name')->implode(', ') ?: 'Sin rol asignado' }}
                    </span>
                </div>
            </li>
        @endforeach
    </ul>
</div>