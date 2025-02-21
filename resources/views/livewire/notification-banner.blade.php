<div class="w-full">
    @if ($notification && $isVisible)
        <div class="relative w-full bg-{{ $notification->color }}-500 text-white text-center py-3 px-6 shadow-lg">
            <h2 class="text-lg font-bold flex items-center justify-center">
                {{ $notification->title }}
            </h2>
            <p class="mt-1">{!! $notification->message !!}</p>

            {{-- Botón de cierre estilo tarjeta --}}
            <button wire:click="closeBanner"
                class="absolute top-2 right-4 text-white text-lg font-bold hover:text-gray-300">
                ✖
            </button>
        </div>
    @endif
</div>
