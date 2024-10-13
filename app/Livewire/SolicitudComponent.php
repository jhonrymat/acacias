<?php
namespace App\Livewire;

use App\Models\User;
use App\Models\Solicitud;
use App\Models\Direccion;
use App\Models\Barrio;
use Livewire\Component;
use Livewire\WithFileUploads; // Para manejar la subida de archivos

class SolicitudComponent extends Component
{
    use WithFileUploads;

    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }
    public $solicitud_id;
    public $fechaSolicitud;
    public $numeroIdentificacion_id;
    public $fechaActual;
    public $barrio_id;
    public $direccion_id;
    public $ubicacion;
    public $evidenciaPDF;
    public $existingPDF;
    public $showForm = false;



    protected $rules = [
        'fechaSolicitud' => 'required|date',
        'numeroIdentificacion_id' => 'required|string|max:50',
        'fechaActual' => 'required|date',
        'barrio_id' => 'required|exists:barrios,id',
        'direccion_id' => 'required|exists:direcciones,id',
        'ubicacion' => 'required|string|max:100',
        'evidenciaPDF' => 'nullable|file|mimes:pdf|max:10240' // Máximo 10MB
    ];

    protected $listeners = ['edit', 'delete'];




    public function save()
    {
        $this->validate();

        if ($this->solicitud_id) {
            $solicitud = Solicitud::find($this->solicitud_id);

            if ($this->evidenciaPDF) {
                $filePath = $this->evidenciaPDF->store('evidencias'); // Almacena el archivo PDF
            } else {
                $filePath = $this->existingPDF;
            }

            $solicitud->update([
                'fechaSolicitud' => $this->fechaSolicitud,
                'numeroIdentificacion_id' => $this->numeroIdentificacion_id,
                'fechaActual' => $this->fechaActual,
                'barrio_id' => $this->barrio_id,
                'direccion_id' => $this->direccion_id,
                'ubicacion' => $this->ubicacion,
                'evidenciaPDF' => $filePath
            ]);
        } else {
            $filePath = $this->evidenciaPDF ? $this->evidenciaPDF->store('evidencias') : null;

            Solicitud::create([
                'fechaSolicitud' => $this->fechaSolicitud,
                'numeroIdentificacion_id' => $this->numeroIdentificacion_id,
                'fechaActual' => $this->fechaActual,
                'barrio_id' => $this->barrio_id,
                'direccion_id' => $this->direccion_id,
                'ubicacion' => $this->ubicacion,
                'evidenciaPDF' => $filePath
            ]);
        }

        $this->resetFields();
        $this->showForm = false;
        $this->dispatch('Updated');
    }

    public function edit($Id)
    {
        $solicitud = Solicitud::find($Id);

        if ($solicitud) {
            $this->solicitud_id = $solicitud->id;
            $this->fechaSolicitud = $solicitud->fechaSolicitud;
            $this->numeroIdentificacion_id = $solicitud->numeroIdentificacion_id;
            $this->fechaActual = $solicitud->fechaActual;
            $this->barrio_id = $solicitud->barrio_id;
            $this->direccion_id = $solicitud->direccion_id;
            $this->ubicacion = $solicitud->ubicacion;
            $this->existingPDF = $solicitud->evidenciaPDF;
            $this->showForm = true;
        }
    }


    public function create()
    {
        $this->resetFields();
        $this->showForm = true;
    }

    public function delete($Id)
    {
        $solicitud = Solicitud::find($Id);
        $solicitud->delete();
        $this->dispatch('Updated');
    }

    public function resetFields()
    {
        $this->solicitud_id = null;
        $this->fechaSolicitud = null;
        $this->numeroIdentificacion_id = null;
        $this->fechaActual = null;
        $this->barrio_id = null;
        $this->direccion_id = null;
        $this->ubicacion = null;
        $this->evidenciaPDF = null;
        $this->existingPDF = null;
    }

//datos del model

    public function render()
    {


         return view('livewire.solicitud-component', [
            'solicitudes' => Solicitud::with('barrio', 'direccion'), // Paginación de 10 elementos


        ]);
    }
}
