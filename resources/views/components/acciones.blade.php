<div class="flex space-x-2">
    <!-- Botón para emitir el evento 'edit' con el ID -->
    <button wire:click="$dispatch('edit', {{ $row->id }})" class="px-4 py-2 bg-blue-500 text-white rounded">
        Editar
    </button>

    <!-- Botón para emitir el evento 'delete' con el ID -->
    <button wire:click="$dispatch('delete', {{ $row->id }})" class="px-4 py-2 bg-red-500 text-white rounded">
        Eliminar
    </button>
</div>
