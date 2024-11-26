<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Solicitud;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudesComponent extends Component
{
    public $nombreCompleto;
    public $email;
    public $telefonoContacto;
    public $id_tipoSolicitante;
    public $id_tipoDocumento;
    public $numeroIdentificacion;
    public $ciudadExpedicion;
    public $fechaNacimiento;
    public $id_nivelEstudio;
    public $id_genero;
    public $id_ocupacion;
    public $id_poblacion;


    public $showForm = false; // Control para mostrar/ocultar el modal
    // variabble para mostrar los datos de user en modal

    public $name;


    protected $listeners = ['view', 'generarPDF', 'viewPDF'];

    public function mount()
    {
        if (!auth()->user()->can('versolicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }

    }

    // Método para mostrar los datos del usuario en el modal
    public function view()
    {
        $userId = auth()->id();
        $user = User::find($userId);

        // Concatenando los nombres
        $this->nombreCompleto = $user->name . ' ' . $user->nombre_2 . ' ' . $user->apellido_1 . ' ' . $user->apellido_2;
        $this->email = $user->email;
        $this->telefonoContacto = $user->telefonoContacto;
        $this->id_tipoSolicitante = $user->tipoSolicitante->tipoSolicitante;
        $this->id_tipoDocumento = $user->tipoDocumento->tipoDocumento;
        $this->numeroIdentificacion = $user->numeroIdentificacion;
        $this->ciudadExpedicion = $user->ciudadExpedicion;
        $this->fechaNacimiento = $user->fechaNacimiento;
        $this->id_nivelEstudio = $user->nivelEstudio->nivelEstudio;
        $this->id_genero = $user->genero->nombreGenero;
        $this->id_ocupacion = $user->ocupacion->nombreOcupacion;
        $this->id_poblacion = $user->poblacion->nombrePoblacion;
        $this->showForm = true;
    }

    public function generarPDF($Id)
    {
        $solicitud = Solicitud::findOrFail($Id);

        // Validar el estado de la solicitud
        if ($solicitud->estado_id !== 5) {
            session()->flash('error', 'La solicitud no está aprobada.');
            return;
        }

        // Datos dinámicos para la plantilla
        $data = [
            'id' => $solicitud->id,
            'solicitante' => trim(
                $solicitud->user->name
                . ' '
                . ($solicitud->user->nombre_2 ?? '')
                . ' '
                . $solicitud->user->apellido_1
                . ' '
                . ($solicitud->user->apellido_2 ?? '')
            ),
            'cedula' => $solicitud->numeroIdentificacion,
            'direccion' => $solicitud->direccion,
            'cargo' => $solicitud->validador2->cargo,
            'validador' => trim(
                $solicitud->validador2->name
                . ' '
                . ($solicitud->validador2->nombre_2 ?? '')
                . ' '
                . $solicitud->validador2->apellido_1
                . ' '
                . ($solicitud->validador2->apellido_2 ?? '')
            ),
            'firma' => $solicitud->validador2->firma,
            'ciudad_expedicion' => $solicitud->user->ciudadExpedicion,
            'barrio_vereda' => $solicitud->barrio->nombreBarrio,
            'tipo_unidad' => $solicitud->barrio->tipoUnidad,
            'codigo_numero' => $solicitud->barrio->codigoNumero,
            'zona' => $solicitud->barrio->zona,
            'estado' => $solicitud->estado->nombreEstado,
            'numero_certificado' => $solicitud->numeroIdentificacion,
            'fecha_emision' => $solicitud->fecha_emision->translatedFormat('d \\de m \\de Y'),
            'vigencia_inicio' => now()->translatedFormat('d \\de m \\de Y'),
            'vigencia_fin' => now()->addYear()->translatedFormat('d \\de m \\de Y'),
            'verificacion_url' => 'https://acacias.gov.co/gfiles/consultaTramite/',
        ];

        // Generar el PDF
        $pdf = Pdf::loadView('certificados.certificado', $data);

        // Descargar el archivo
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'certificado_residencia.pdf');
    }

    public function render()
    {
        $solicitudes = Solicitud::with('user')->get();

        return view('livewire.solicitudes-component', [
            'solicitudes' => $solicitudes
        ]);
    }
}
