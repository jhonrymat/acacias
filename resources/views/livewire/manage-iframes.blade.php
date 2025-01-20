<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-4">Gestión de Iframes</h1>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulario -->
    <form wire:submit.prevent="save" class="space-y-4">
        <input type="hidden" wire:model="iframe_id">

        <div>
            <label class="block text-gray-700 font-medium mb-2">Rol:</label>
            <input
                type="text"
                wire:model="role"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ingrese el rol">
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Título del Iframe:</label>
            <input
                type="text"
                wire:model="iframe_title"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ingrese el título">
            @error('iframe_title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">URL del Iframe:</label>
            <input
                type="text"
                wire:model="iframe_src"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ingrese la URL">
            @error('iframe_src')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Guardar
            </button>
            <button
                type="button"
                wire:click="resetForm"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
                Cancelar
            </button>
        </div>
    </form>

    <!-- Lista de Iframes -->
    <h2 class="text-xl font-bold mt-6 mb-4">Lista de Iframes</h2>
    @livewire('Manage-Iframes-datatable')
</div>
