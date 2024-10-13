<div>
    <!-- Botón para mostrar el formulario de creación/edición -->
    <button wire:click="$set('showForm', true)" class="px-4 py-2 bg-green-500 text-white">Nuevo Usuario</button>

    <!-- Formulario para crear o editar un usuario -->
    @if ($showForm)
        <div class="mt-4">
            <form wire:submit.prevent="save">
                <input type="text" wire:model="name" placeholder="Nombre" class="border mb-2">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

                <input type="email" wire:model="email" placeholder="Email" class="border mb-2">
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror

                <input type="password" wire:model="password" placeholder="Contraseña" class="border mb-2">
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white">
                    @if ($userId) Actualizar @else Crear @endif
                </button>
            </form>
        </div>
    @endif

    <!-- Tabla generada por el paquete 'rappasoft/laravel-livewire-tables' -->
    <div class="mt-6">
        <livewire:users-table />
    </div>
</div>
