<?php

namespace App\Livewire;

use Log;
use Exception;
use Livewire\Component;
use App\Models\AnulacionAvecindamiento;
use App\Models\SolicitudAvecindamiento;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\SolicitudAvecindamientoAnuladaNotification;

class SolicitudAnulacionAvecindamientoComponent extends Component
{

    use WithFileUploads;

    public $numeroSolicitud, $solicitud, $descripcion, $archivo, $visible;

    protected $rules = [
        'numeroSolicitud' => 'required|integer|exists:solicitudes_avecindamiento,id',
        'descripcion' => 'required|string',
        'archivo' => 'nullable|file|mimes:pdf,jpg,png|max:5120', // Máx 5MB
        'visible' => 'nullable|boolean',
    ];

    protected $messages = [
        'numeroSolicitud.exists' => 'La solicitud no existe.',
        'numeroSolicitud.integer' => 'El número de solicitud debe ser un número entero.',
        'numeroSolicitud.required' => 'El número de solicitud es obligatorio.',
        'descripcion.required' => 'La descripción es obligatoria.',
        'archivo.file' => 'El archivo debe ser un archivo.',
        'archivo.mimes' => 'El archivo debe ser un PDF, JPG o PNG.',
        'archivo.max' => 'El archivo no puede ser mayor a 5MB.',
        'visible.boolean' => 'El campo visible debe ser un valor booleano.',

    ];

    public function buscarSolicitud()
    {
        $this->solicitud = SolicitudAvecindamiento::where('id', $this->numeroSolicitud)
            ->where('estado_id', 5) // Solo si el estado es "Emitido"
            ->first();

        if (!$this->solicitud) {
            session()->flash('error', 'Solicitud no encontrada o no está en estado emitido.');
        }
    }

    // preguntar si desea anular la solicitud
    public function confirmarAnulacion()
    {
        if (!$this->solicitud) {
            session()->flash('error', 'No se encontró la solicitud.');
            return;
        }

        $this->dispatch(
            'anular',
            icon: 'info',
            title: '¿Estás seguro?',
            text: 'Anularas la solicitud #' . $this->solicitud->id . '.',
        );
        $this->dispatch('Updated');
    }

    public function anularSolicitud()
    {
        $this->validate();

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
        AnulacionAvecindamiento::create([
            'solicitud_id' => $this->solicitud->id,
            'usuario_id' => Auth::id(),
            'descripcion' => $this->descripcion,
            'archivo' => $archivoAnulado, // Se almacena solo si se subió archivo
            'visible' => $this->visible ? 1 : 0,
        ]);

        // Actualizar estado de la solicitud a "Anulado" (ID = 8)
        $this->solicitud->update(['estado_id' => 8]);

        // Enviar el correo
        $userName = $this->solicitud->NombreCompleto;
        $userEmail = $this->solicitud->user->email;

        Mail::to($userEmail)->send(new SolicitudAvecindamientoAnuladaNotification($this->solicitud->id, $userName));

        // Mensaje de éxito y reseteo del formulario
        session()->flash('success', 'Solicitud anulada correctamente.');
        $this->reset(['descripcion', 'archivo', 'visible', 'solicitud', 'numeroSolicitud']);
    }
    public function render()
    {
        return view('livewire.solicitud-anulacion-avecindamiento-component');
    }
}
