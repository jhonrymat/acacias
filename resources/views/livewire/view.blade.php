<div class="flex space-x-2">
    {{-- Verifica si el estado es "Emitido" --}}
    @php
        // Buscar la primera validación con el id_solicitud actual
        $validacion = $row['validaciones']->where('id_solicitud', $row->id)->first();
        use Illuminate\Support\Facades\DB;
        $ifAnulacion = DB::table('anulaciones')->where('solicitud_id', $row->id)->first();

    @endphp

    @if ($row['estado.nombreEstado'] === 'Emitido')
        <button wire:click="$dispatch('generarPDF', { Id: {{ $row->id }} })"
            class="px-4 py-2 bg-green-500 text-white rounded">
            <i class="fa-solid fa-file-arrow-down"></i> Descargar
        </button>
        <a href="{{ route('solicitud.verPDF.avecindamiento', ['id' => $row->id]) }}" target="_blank"
            class="px-4 py-2 bg-blue-500 text-white rounded">
            <i class="fa-solid fa-eye"></i> Ver
        </a>
        {{-- Si la solicitud fue "Anulada", mostrar botón para ver detalles --}}
    @elseif ($row['estado.nombreEstado'] === 'Anulado')
        @if ($ifAnulacion?->visible === 1)
            <button wire:click="$dispatch('verAnulacion', { Id: {{ $row->id }} })"
                class="px-4 py-2 bg-red-600 text-white rounded">
                <i class="fa-solid fa-eye"></i> Ver Anulación
            </button>
        @else
            <p class="text-gray-500">
                Anulación no disponible,
                debera acercarse a la oficina.
            </p>
        @endif
        {{-- Si la solicitud fue "no completado", mostrar botón para ver detalles --}}
    @elseif($row['estado.nombreEstado'] === 'No completado' && optional($validacion)->visible == 1)
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
