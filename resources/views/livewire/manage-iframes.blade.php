<div>
    <h1>Gestión de Iframes</h1>
    @if (session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <input type="hidden" wire:model="iframe_id">

        <label>Rol:</label>
        <input type="text" wire:model="role">
        @error('role') <span style="color: red;">{{ $message }}</span> @enderror

        <label>Título del Iframe:</label>
        <input type="text" wire:model="iframe_title">
        @error('iframe_title') <span style="color: red;">{{ $message }}</span> @enderror

        <label>URL del Iframe:</label>
        <input type="text" wire:model="iframe_src">
        @error('iframe_src') <span style="color: red;">{{ $message }}</span> @enderror

        <button type="submit">Guardar</button>
        <button type="button" wire:click="resetForm">Cancelar</button>
    </form>

    <h2>Lista de Iframes</h2>
    <table border="1" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Rol</th>
                <th>Título</th>
                <th>URL</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($iframes as $iframe)
                <tr>
                    <td>{{ $iframe['role'] }}</td>
                    <td>{{ $iframe['iframe_title'] }}</td>
                    <td>{{ $iframe['iframe_src'] }}</td>
                    <td>
                        <button wire:click="edit({{ $iframe['id'] }})">Editar</button>
                        <button wire:click="delete({{ $iframe['id'] }})" style="color: red;">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
