<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Configuración del Sitio</h1>

    @if (session('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <!-- Nombre del Sitio -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Nombre del sitio:</label>
            <input type="text" wire:model="site_name" class="w-full px-4 py-2 border rounded-lg">
            @error('site_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Logo -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Logo:</label>
            <input type="file" wire:model="logo" class="block w-full">
            @if ($existing_logo)
                <img src="{{ asset( 'storage/' . $existing_logo) }}" alt="Logo" class="mt-2 h-16">
            @endif
            @error('logo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Favicon -->
        <div>
            <label class="block text-gray-700 font-medium mb-2">Favicon:</label>
            <input type="file" wire:model="favicon" class="block w-full">
            @if ($existing_favicon)
                <img src="{{ asset( 'storage/' . $existing_favicon) }}" alt="Favicon" class="mt-2 h-8">
            @endif
            @error('favicon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Botón Guardar -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Guardar Cambios
        </button>
    </form>

    <div class="mt-6">
        <button wire:click="clearCache" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
            Limpiar Caché
        </button>
    </div>
</div>
