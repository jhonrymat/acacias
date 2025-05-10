<div class="w-3/4 mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Modulo para exportar data de Solicitudes de Residencia</h1>
    </div>
    <!-- Componente de tabla -->
    <livewire:solicitudes-export-table key="{{ now() }}" />
    <x-sweet-alert-good></x-sweet-alert-good>
</div>
