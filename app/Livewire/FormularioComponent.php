<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Barrio;
use App\Models\Genero;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Nestudio;
use App\Models\Solicitud;
use App\Models\Tdocumento;
use App\Models\Tsolicitante;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Mail\SolicitudCreadaNotification;
use Illuminate\Support\Facades\Mail;

class FormularioComponent extends Component
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
        'cedula.required' => 'El campo cédula es necesario para crear la solicitud.',
        'recibo.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, jpg',
        'recibo.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'recibo.required' => 'El campo recibo es necesario para crear la solicitud.',
        'terminos.required' => 'El campo términos es obligatorio.',
        'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
    ];

    public function save()
    {

        $userId = auth()->id();

        // Verificar si el usuario puede crear una nueva solicitud
        if (!Solicitud::canCreateRequest($userId)) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Solicitud activa.', text: 'No puedes crear una nueva solicitud mientras tengas una activa, procesando o pendiente.', footer: '<a href="versolicitudesresidencia">Ver mis solicitudes</a>');
            return;
        }

        // Validate form data
        $validatedData = $this->validate();

        // Procesar cada archivo individualmente
        $files = [
            'accion_comunal' => $this->accion_comunal,
            'electoral' => $this->electoral,
            'sisben' => $this->sisben,
            'cedula' => $this->cedula,
            'recibo' => $this->recibo,
        ];

        // Crear un array para almacenar las rutas de los archivos procesados
        $filePaths = [];

        foreach ($files as $key => $file) {
            if ($file) {
                // Obtener el nombre original del archivo
                $originalName = $file->getClientOriginalName();
                // Obtener la extensión del archivo
                $extension = $file->getClientOriginalExtension();
                // Limpiar caracteres especiales del nombre original
                $fileNameSanitized = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                // Crear un nombre único: nombre original limpio + fecha y hora
                $fileName = $fileNameSanitized . '_' . now()->format('Ymd_His') . '.' . $extension;
                // Guardar el archivo en la carpeta específica según el tipo de archivo
                $path = $file->storeAs($key, $fileName, 'public');
                // Almacenar la ruta del archivo en el array
                $filePaths[$key] = $path;
            } else {
                $filePaths[$key] = null; // No se subió archivo
            }
        }

        // Crear una nueva solicitud y guardar las rutas de los archivos en la base de datos

        $solicitud = Solicitud::create([
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
            'estado_id' => 1, // Estado inicial de 'Pendiente'
        ]);

        // Enviar el correo
        $userName = auth()->user()->name;
        Mail::to(auth()->user()->email)->send(new SolicitudCreadaNotification($solicitud->id, $userName));


        $this->reset();
        // Mostrar mensaje de éxito
        // session()->flash('message', 'Solicitud creada exitosamente.');
        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Solicitud creada exitosamente.', text: 'Tu solicitud ha sido enviada correctamente.', footer: '<a href="versolicitudesresidencia">Ver mis solicitudes</a>');


        // Resetear el formulario
        $this->redirect(route('versolicitudesresidencia'));
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

        // Asignar el valor de numeroIdentificacion a la propiedad pública del componente
        if (!$this->numeroIdentificacion) {
            $this->numeroIdentificacion = $user->numeroIdentificacion;
        }

        return view('livewire.formulario-component', [
            'user' => $user,
            'barrios' => $barrios,
        ]);

    }
}
