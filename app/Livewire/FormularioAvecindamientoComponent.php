<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Barrio;
use App\Models\Genero;
use Livewire\Component;
use App\Models\Nestudio;
use App\Models\Tdocumento;
use App\Models\Tsolicitante;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\SolicitudAvecindamiento;
use Illuminate\Support\Facades\Storage;
use App\Mail\SolicitudAvecindamientoCreadaNotification;

class FormularioAvecindamientoComponent extends Component
{

    use WithFileUploads;

    public $openModal = false; // Inicializar $openModal como false
    public $tipoViaPrimaria = '';
    public $numeroViaPrincipal = '';
    public $letraViaPrincipal = '';
    public $bis = '';
    public $letraBis = '';
    public $cuadranteViaPrincipal = '';
    public $numeroViaGeneradora = '';
    public $letraViaGeneradora = '';
    public $numeroPlaca = '';
    public $cuadranteViaGeneradora = '';
    public $direccionGenerada = '';
    public $complemento = '';
    public $otro = '';


    public $numeroIdentificacion = '';
    public $fechaNacimiento = '';
    public $id_barrio = '';
    public $direccion = '';
    public $lat; // Latitud seleccionada
    public $lng; // Longitud seleccionada
    public $accion_comunal = '';
    public $electoral = '';
    public $sisben = '';
    public $cedula = '';
    public $recibo = '';

    public $terminos = '';
    public $observaciones = '';

    public $tipoPersonaCargo = '';
    public $nombrePersonaCargo = '';
    public $documentoPersonaCargo = '';
    public $nombrePadre = '';
    public $documentoPadre = '';
    public $nombreMadre = '';
    public $documentoMadre = '';





    protected $listeners = ['updateLocation'];
    protected $rules = [
        'numeroIdentificacion' => 'required|string|min:3',
        'id_barrio' => 'required',
        'direccion' => 'required|string|min:3',
        'lat' => 'nullable|numeric',
        'lng' => 'nullable|numeric',
        'accion_comunal' => 'file|mimes:pdf,jpeg,jpg|max:10240', // Valida cada archivo individualmente
        'electoral' => 'file|mimes:pdf,jpeg,jpg|max:10240', // Valida cada archivo individualmente
        'sisben' => 'file|mimes:pdf,jpeg,jpg|max:10240', // Valida cada archivo individualmente
        'cedula' => 'required|file|mimes:pdf,jpeg,jpg|max:10240', // Valida cada archivo individualmente
        'recibo' => 'required|file|mimes:pdf,jpeg,jpg|max:10240', // Valida cada archivo individualmente
        'terminos' => 'required',
        'observaciones' => 'nullable|string',
    ];
    protected $messages = [
        'numeroIdentificacion.required' => 'El campo número de identificación es obligatorio.',
        'numeroIdentificacion.min' => 'El campo número de identificación debe tener al menos 3 caracteres.',
        'id_barrio.required' => 'El campo barrio es obligatorio.',
        'direccion.required' => 'El campo dirección es obligatorio.',
        'direccion.min' => 'El campo dirección debe tener al menos 3 caracteres.',
        'lat.numeric' => 'El campo latitud debe ser un número.',
        'lng.numeric' => 'El campo longitud debe ser un número.',
        'accion_comunal.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, jpg',
        'accion_comunal.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'electoral.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, jpg',
        'electoral.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'sisben.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, jpg',
        'sisben.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'cedula.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, jpg',
        'cedula.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'cedula.required' => 'El campo cédula es necesario.',
        'recibo.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, jpg',
        'recibo.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'recibo.required' => 'El campo recibo es necesario.',
        'terminos.required' => 'El campo términos es obligatorio.',
        'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
    ];

    public function save()
    {
        $userId = auth()->id();

        // Verificar si el usuario puede crear una nueva solicitud
        if (!SolicitudAvecindamiento::canCreateRequest($userId)) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud activa.', text: 'No puedes crear una nueva solicitud mientras tengas una activa, procesando o pendiente.', footer: '<a href="versolicitudesavecindamiento">Ver mis solicitudes</a>');
            return;
        }

        // Validar campos generales del formulario
        $this->validate();

        $esMenorDeEdad = Carbon::parse($this->fechaNacimiento)->age < 18;

        $nombreCargo = null;
        $documentoCargo = null;

        if ($esMenorDeEdad) {
            $this->validate([
                'tipoPersonaCargo' => 'required|string',
            ]);

            if ($this->tipoPersonaCargo === 'padre y madre') {
                $this->validate([
                    'nombrePadre' => 'required|string',
                    'documentoPadre' => 'required|string',
                    'nombreMadre' => 'required|string',
                    'documentoMadre' => 'required|string',
                ]);
                $nombreCargo = "Padre: {$this->nombrePadre} / Madre: {$this->nombreMadre}";
                $documentoCargo = "{$this->documentoPadre} / {$this->documentoMadre}";
            } else {
                $this->validate([
                    'nombrePersonaCargo' => 'required|string',
                    'documentoPersonaCargo' => 'required|string',
                ]);
                $nombreCargo = $this->nombrePersonaCargo;
                $documentoCargo = $this->documentoPersonaCargo;
            }
        }

        // Procesar los archivos
        $files = [
            'accion_comunal' => $this->accion_comunal,
            'electoral' => $this->electoral,
            'sisben' => $this->sisben,
            'cedula' => $this->cedula,
            'recibo' => $this->recibo,
        ];

        $filePaths = [];

        foreach ($files as $key => $file) {
            if ($file) {
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileNameSanitized = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                $fileName = $fileNameSanitized . '_' . now()->format('Ymd_His') . '.' . $extension;
                $path = $file->storeAs($key, $fileName, 'public');
                $filePaths[$key] = $path;
            } else {
                $filePaths[$key] = null;
            }
        }

        // Crear la solicitud
        $solicitud = SolicitudAvecindamiento::create([
            'user_id' => $userId,
            'numeroIdentificacion' => $this->numeroIdentificacion,
            'id_barrio' => $this->id_barrio,
            'direccion' => $this->direccion,
            'lat' => $this->lat ? rtrim(rtrim($this->lat, '0'), '.') : null,
            'lng' => $this->lng ? rtrim(rtrim($this->lng, '0'), '.') : null,
            'accion_comunal' => $filePaths['accion_comunal'],
            'electoral' => $filePaths['electoral'],
            'sisben' => $filePaths['sisben'],
            'cedula' => $filePaths['cedula'],
            'recibo' => $filePaths['recibo'],
            'observaciones' => $this->observaciones ?? null,
            'terminos' => $this->terminos,
            'estado_id' => 1,
            'tipo_persona_cargo' => $esMenorDeEdad ? $this->tipoPersonaCargo : null,
            'nombre_persona_cargo' => $esMenorDeEdad ? $nombreCargo : null,
            'documento_persona_cargo' => $esMenorDeEdad ? $documentoCargo : null,
        ]);

        // Enviar notificación
        $userName = auth()->user()->name;
        Mail::to(auth()->user()->email)->send(new SolicitudAvecindamientoCreadaNotification($solicitud->id, $userName));

        $this->reset();

        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Solicitud creada exitosamente.', text: 'Tu solicitud ha sido enviada correctamente.', footer: '<a href="versolicitudesavecindamiento">Ver mis solicitudes</a>');

        $this->redirect(route('versolicitudesavecindamiento'));
    }



    public function updateLocation($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }



    public function render()
    {
        // Obtener el usuario autenticado
        $user = User::find(auth()->id());
        $barrios = Barrio::orderBy('nombreBarrio', 'asc')->get();

        if (!$this->numeroIdentificacion) {
            $this->numeroIdentificacion = $user->numeroIdentificacion;
        }

        if (!$this->fechaNacimiento) {
            $this->fechaNacimiento = $user->fechaNacimiento;
        }

        // Verificar si es menor de edad
        $esMenorDeEdad = false;

        if ($this->fechaNacimiento) {
            $edad = Carbon::parse($this->fechaNacimiento)->age;
            $esMenorDeEdad = $edad < 18;
        }

        return view('livewire.formulario-avecindamiento-component', [
            'user' => $user,
            'barrios' => $barrios,
            'esMenorDeEdad' => $esMenorDeEdad,
        ]);
    }
}
