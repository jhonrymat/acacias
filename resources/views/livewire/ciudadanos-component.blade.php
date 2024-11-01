<div>
   <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ciudadanos registrados') }}
        </h2>
    </x-slot>

    <!-- Tabla generada por el paquete 'rappasoft/laravel-livewire-tables' -->
    <div class="w-3/4 mx-auto py-6">
        <livewire:ciudadanos-datatable />
    </div>
</div>
