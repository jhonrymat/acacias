<div>
    <button wire:click="toggleFavorito({{ $row->id }})" class="border-0 bg-transparent">
        @if((bool) $row->es_favorito)
            <i class="fas fa-star text-yellow-400"></i>  <!-- Estrella activa -->
        @else
            <i class="far fa-star text-gray-400"></i>    <!-- Estrella opaca -->
        @endif
    </button>
</div>
