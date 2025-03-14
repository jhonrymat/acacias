<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Anulacion;
use App\Models\Solicitud;
use App\Models\Validacion;
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
    public $notasDelValidador;


    public $showForm = false; // Control para mostrar/ocultar el modal
    // variabble para mostrar los datos de user en modal
    public $abrirmodal = false;

    public $name;

    // Ver por que se anulo la solicitud
    public $mostrarModal = false;
    public $descripcionAnulacion, $archivoAnulacion, $visibleAnulacion;




    protected $listeners = ['view', 'generarPDF', 'viewPDF', 'mostrarNotas', 'verAnulacion'];

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
            session()->flash('error', 'La solicitud no está emitida.');
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
            'tipoDocumento' => $solicitud->user->tipoDocumento->tipoDocumento,
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
            'codigo_validador1' => $solicitud->actualizador->codigo,
            'firma' => $solicitud->validador2->firma,
            'ciudad_expedicion' => $solicitud->user->ciudadExpedicion,
            'barrio_vereda' => $solicitud->barrio->nombreBarrio,
            'tipo_unidad' => $solicitud->barrio->tipoUnidad,
            'codigo_numero' => $solicitud->barrio->codigoNumero,
            'zona' => $solicitud->barrio->zona,
            'estado' => $solicitud->estado->nombreEstado,
            'numero_certificado' => $solicitud->numeroIdentificacion,
            'fecha_emision' => $solicitud->fecha_emision
                ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                : 'N/A',
            'vigencia_inicio' => $solicitud->fecha_emision
                ? Carbon::parse($solicitud->fecha_emision)->translatedFormat('d \\de F \\de Y')
                : 'N/A',

            'vigencia_fin' => $solicitud->VigenciaFormateada,

            'verificacion_url' => env('APP_URL') . '/consulta-tramite',
            'qr' => public_path('storage/' . $solicitud->validaciones->first()->qr_url),
        ];

        // Generar el PDF
        $pdf = Pdf::loadView('certificados.certificado', $data);

        // Descargar el archivo
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $solicitud->id . '_' . $solicitud->numeroIdentificacion . '_certificado.pdf');
    }

    public function viewPDF($Id)
    {
        return redirect()->route('solicitud.verPDF', ['id' => $Id]);
    }

    public function mostrarNotas($Id)
    {
        $validacion = Validacion::find($Id);

        if ($validacion) {
            $this->notasDelValidador = $validacion->notas;
            $this->abrirmodal = true;
        } else {
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'No se encontraron las notas.');
        }

    }

    public function verAnulacion($Id)
    {
        // Buscar la anulación de la solicitud
        $anulacion = Anulacion::where('solicitud_id', $Id)->first();

        if ($anulacion) {
            $this->descripcionAnulacion = $anulacion->descripcion;
            $this->archivoAnulacion = $anulacion->archivo;
            $this->visibleAnulacion = $anulacion->visible;

            // Mostrar el modal
            $this->mostrarModal = true;
        } else {
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: 'No se encontró información de anulación.');
        }
    }

    public function render()
    {
        $solicitudes = Solicitud::with('user')->get();

        return view('livewire.solicitudes-component', [
            'solicitudes' => $solicitudes
        ]);
    }
}
