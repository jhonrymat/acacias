<div class="flex space-x-2">
    {{-- Verifica si el estado es "Emitido" --}}
    @php
        // Buscar la primera validación con el id_solicitud actual
        $validacion = $row['validaciones']->where('id_solicitud', $row->id)->first();
    @endphp

    @if ($row['estado.nombreEstado'] === 'Emitido')
        <button wire:click="$dispatch('generarPDF', { Id: {{ $row->id }} })"
            class="px-4 py-2 bg-green-500 text-white rounded">
            <i class="fa-solid fa-file-arrow-down"></i> Descargar
        </button>
        <a href="{{ route('solicitud.verPDF', ['id' => $row->id]) }}" target="_blank"
            class="px-4 py-2 bg-blue-500 text-white rounded">
            <i class="fa-solid fa-eye"></i> Ver
        </a>
    @elseif($row['estado.nombreEstado'] === 'Rechazada' && optional($validacion)->visible === 1)
        <button wire:click="$dispatch('mostrarNotas', { Id: {{ optional($validacion)->id }}})"
            class="px-4 py-2 bg-blue-500 text-white rounded">
            Ver detalles
        </button>
    @else
        <span class="text-gray-500">
            El certificado no está disponible actualmente
        </span>
    @endif
</div>
