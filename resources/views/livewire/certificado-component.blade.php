<div>
    <h3>Descargar Certificado</h3>

    <form wire:submit.prevent="generarPDF">
        <div>
            <label for="solicitudId">ID de la Solicitud:</label>
            <input type="number" wire:model="solicitudId" id="solicitudId" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Descargar Certificado
        </button>
    </form>

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
