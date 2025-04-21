<div class="flex space-x-2">
    <button wire:click="$dispatch('edit' , { Id: {{ $row->id }} })" class="px-4 py-2 bg-purple-500 text-white rounded">
        <i class="fa-regular fa-address-book fa-lg"></i>
    </button>
    {{-- historial --}}
    <button wire:click="$dispatch('history' , { Id: {{ $row->id }} })"
        class="px-4 py-2 bg-blue-500 text-white rounded">
        <i class="fa-solid fa-book-open fa-lg"> R</i>
    </button>
    {{-- historial Avecindamiento--}}
    <button wire:click="$dispatch('historyAvecindamiento' , { Id: {{ $row->id }} })"
        class="px-4 py-2 bg-green-500 text-white rounded">
        <i class="fa-solid fa-book-open fa-lg"> A</i>
    </button>
</div>
