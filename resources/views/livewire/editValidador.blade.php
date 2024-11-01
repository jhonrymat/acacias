<div class="flex space-x-2">
    <button wire:click="$dispatch('edit' , { Id: {{ $row->id }} })" class="px-4 py-2 bg-blue-500 text-white rounded">
        <i class="fa-regular fa-address-book fa-lg"></i>
    </button>
</div>
