<div class="flex space-x-2">
    <!-- Emitir el evento 'edit' hacia el componente 'user-component' -->
    <button wire:click="$dispatch('edit', {{ $row->id }})" class="px-4 py-2 bg-blue-500 text-white">
        Editar
    </button>

    <!-- Emitir el evento 'delete' hacia el componente 'user-component' -->
    <button wire:click="$dispatch('delete', {{ $row->id }})" class="px-4 py-2 bg-red-500 text-white">
        Eliminar
    </button>
</div>
