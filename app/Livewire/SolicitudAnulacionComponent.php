<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Solicitud;
use App\Models\Anulacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SolicitudAnulacionComponent extends Component
{
    use WithFileUploads;

    public $numeroSolicitud, $solicitud, $descripcion, $archivo, $visible;

    public function buscarSolicitud()
    {
        $this->solicitud = Solicitud::where('id', $this->numeroSolicitud)
            ->where('estado_id', 5) // Solo si el estado es "Emitido"
            ->first();

        if (!$this->solicitud) {
            session()->flash('error', 'Solicitud no encontrada o no está en estado emitido.');
        }
    }

    public function anularSolicitud()
    {
        $this->validate([
            'descripcion' => 'required|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,png|max:5120', // Máx 5MB
        ]);

        // Verificar si la carpeta "anulados" existe en `storage/app/public/anulados`
        if (!Storage::exists('public/anulados')) {
            Storage::makeDirectory('public/anulados');
        }

        // Procesar el archivo si se subió uno
        $archivoAnulado = null;
        if ($this->archivo) {
            // Obtener la extensión y nombre base del archivo
            $extension = $this->archivo->getClientOriginalExtension();
            $fileNameSanitized = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($this->archivo->getClientOriginalName(), PATHINFO_FILENAME));

            // Generar un nombre único para evitar conflictos
            $fileName = $fileNameSanitized . '_' . now()->format('Ymd_His') . '.' . $extension;

            // Guardar el archivo en `storage/app/public/anulados/`
            $archivoAnulado = $this->archivo->storeAs('anulados', $fileName, 'public');
        }

        // Verificar que la solicitud es válida antes de proceder
        if (!$this->solicitud) {
            session()->flash('error', 'No se encontró la solicitud.');
            return;
        }

        // Crear el registro de anulación en la base de datos
        Anulacion::create([
            'solicitud_id' => $this->solicitud->id,
            'usuario_id' => Auth::id(),
            'descripcion' => $this->descripcion,
            'archivo' => $archivoAnulado, // Se almacena solo si se subió archivo
            'visible' => $this->visible ? 1 : 0,
        ]);

        // Actualizar estado de la solicitud a "Anulado" (ID = 8)
        $this->solicitud->update(['estado_id' => 8]);

        // Mensaje de éxito y reseteo del formulario
        session()->flash('success', 'Solicitud anulada correctamente.');
        $this->reset(['descripcion', 'archivo', 'visible', 'solicitud', 'numeroSolicitud']);
    }
    public function render()
    {
        return view('livewire.solicitud-anulacion-component');
    }
}
