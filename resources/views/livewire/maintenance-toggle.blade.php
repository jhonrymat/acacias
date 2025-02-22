<!-- resources/views/livewire/maintenance-toggle.blade.php -->

<div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Modo de Mantenimiento</h2>

    <button wire:click="toggleMaintenance" class="px-4 py-2 rounded bg-blue-600 text-white">
        {{ $isMaintenanceOn ? 'Desactivar Mantenimiento' : 'Activar Mantenimiento' }}
    </button>

    @if ($isMaintenanceOn && $secretUrl)
        <div class="mt-4 p-2 bg-gray-100 rounded">
            <strong>Enlace secreto:</strong> <a href="{{ $secretUrl }}" class="text-blue-600">{{ $secretUrl }}</a>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-2 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</div>
