<div class="flex space-x-2">
    <button wire:click="$dispatch('view' , { Id: {{ $row->id }} })" class="px-4 py-2 bg-blue-500 text-white rounded">
        <i class="fa-regular fa-address-book fa-lg"></i>
    </button>
    {{-- solo lo puede ver el rol validador1 --}}
    @if (auth()->user()->hasRole('validador1'))
        <button wire:click="$dispatch('procesar' , { Id: {{ $row->id }} })"
            class="px-4 py-2 bg-green-500 text-white rounded">
            <i class="fa-solid fa-house-circle-check fa-lg"></i>
        </button>
    @endif

</div>
