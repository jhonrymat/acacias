<div class="flex space-x-2">
    <button wire:click="$dispatch('view' , { Id: {{ $row->id }} })" class="px-4 py-2 bg-blue-500 text-white rounded">
        <i class="fa-regular fa-address-book fa-lg"></i>
    </button>
    @if (auth()->user()->hasRole('validador2'))
        <div class="flex space-x-2">
            <button wire:click="$dispatch('see' , { Id: {{ $row->id }} })"
                class="px-4 py-2 bg-yellow-500 text-white rounded">
                <i class="fa-regular fa-eye fa-lg"></i>
            </button>
        </div>
        <div class="flex space-x-2">
            <button wire:click="$dispatch('validar' , { Id: {{ $row->id }} })"
                class="px-4 py-2 bg-green-500 text-white rounded">
                <i class="fa-regular fa-check-square fa-lg"></i>
            </button>
        </div>
        <div class="flex space-x-2">
            <button wire:click="$dispatch('rechazar' , { Id: {{ $row->id }} })"
                class="px-4 py-2 bg-red-500 text-white rounded">
                <i class="fa-regular fa-thumbs-down fa-lg"></i>
            </button>
        </div>
    @endif
    {{-- solo lo puede ver el rol validador1 --}}
    @if (auth()->user()->hasRole('validador1'))
        <button wire:click="$dispatch('procesar' , { Id: {{ $row->id }} })"
            class="px-4 py-2 bg-green-500 text-white rounded">
            <i class="fa-solid fa-house-circle-check fa-lg"></i>
        </button>
    @endif
</div>
