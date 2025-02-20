<div class="p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold mb-4">Administrar Notificaciones</h2>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label class="block">Título</label>
            <input type="text" wire:model="title" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block">Mensaje</label>
            <textarea wire:model="message" class="w-full p-2 border rounded" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block">Color</label>
            <select wire:model="color" class="w-full p-2 border rounded" required>
                <option value="blue">Azul</option>
                <option value="red">Rojo</option>
                <option value="yellow">Amarillo</option>
                <option value="green">Verde</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Posición</label>
            <select wire:model="position" class="w-full p-2 border rounded" required>
                <option value="both">Ambas Ubicaciones</option>
                <option value="welcome">Solo en Welcome</option>
                <option value="navbar">Solo en Navbar</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block">Activo</label>
            <input type="checkbox" wire:model="active" value="1">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Guardar</button>
    </form>

    <h3 class="text-lg font-bold mt-6">Lista de Notificaciones</h3>
    <ul class="mt-4">
        @foreach ($notifications as $notif)
            <li class="border p-2 mt-2 flex justify-between items-center">
                <span class="text-{{ $notif->color }}-500">{{ $notif->title }}</span>
                <div>
                    <button wire:click="edit({{ $notif->id }})"
                        class="bg-yellow-500 text-white py-1 px-3 rounded">Editar</button>
                    <button wire:click="delete({{ $notif->id }})"
                        class="bg-red-500 text-white py-1 px-3 rounded">Eliminar</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
