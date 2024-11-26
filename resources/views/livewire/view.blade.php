<div class="flex space-x-2">
    {{-- Verifica si el estado es "Emitido" --}}
    @if($row['estado.nombreEstado'] === 'Emitido')
        <button wire:click="$dispatch('generarPDF', { Id: {{ $row->id }} })" class="px-4 py-2 bg-green-500 text-white rounded">
            <i class="fa-solid fa-file-arrow-down"></i> Descargar
        </button>
    @else
        <span class="text-gray-500">
            El certificado aún no ha sido emitido.
        </span>
    @endif
</div>
