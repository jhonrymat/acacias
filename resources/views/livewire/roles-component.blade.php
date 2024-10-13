<div class="p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">{{ $isEditing ? 'Editar Rol' : 'Gestión de Roles' }}</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="createOrUpdateRole" class="mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nombre del Rol -->
            <div class="col-span-1">
                <label for="role-name" class="block text-sm font-medium text-gray-700">Nombre del rol</label>
                <input type="text" id="role-name" wire:model="name" placeholder="Nombre del rol"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <!-- Selección de Permisos -->
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Seleccionar Permisos</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 max-h-60 overflow-y-auto p-2 border rounded-md">
                    @foreach ($allPermissions as $permission)
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="permission-{{ $permission->id }}"
                                   value="{{ $permission->id }}"
                                   wire:model="permissionIds"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="permission-{{ $permission->id }}" class="ml-2 text-sm text-gray-600">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Botones -->
            <div class="col-span-2 flex justify-end items-center mt-4">
                @if($isEditing)
                    <button type="button" wire:click="cancelEdit"
                        class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        Cancelar
                    </button>
                @endif
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    {{ $isEditing ? 'Actualizar Rol' : 'Crear Rol' }}
                </button>
            </div>
        </div>
    </form>

    <!-- Lista de Roles -->
    <h2 class="text-xl font-semibold mb-4">Lista de Roles</h2>
    <ul class="bg-gray-50 rounded-lg shadow-sm p-4 divide-y divide-gray-200">
        @foreach ($roles as $role)
            <li class="flex justify-between items-center py-3">
                <span class="text-gray-700 font-medium">{{ $role->name }}</span>
                <div class="flex gap-4">
                    <button wire:click="$dispatch('showRoleDetails', { Id: {{ $role->id }}})" class="text-blue-500 hover:text-blue-600">
                        Ver Detalles
                    </button>
                    <button wire:click="editRole({{ $role->id }})" class="text-yellow-500 hover:text-yellow-600">
                        Editar
                    </button>
                    <button wire:click="deleteRole({{ $role->id }})" class="text-red-500 hover:text-red-600">
                        Eliminar
                    </button>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Modal de Detalles del Rol -->
    @if($showRoleDetails && $selectedRole)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="role-details-modal">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Detalles del Rol</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Nombre: {{ $selectedRole->name }}
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        Permisos:
                    </p>
                    <ul class="list-disc list-inside text-sm text-gray-500">
                        @foreach($selectedRole->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="items-center px-4 py-3">
                    <button wire:click="hideRoleDetails" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
