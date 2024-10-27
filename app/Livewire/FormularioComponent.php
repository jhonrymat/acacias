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
    public $accion_comunal = '';
    public $electoral = '';
    public $sisben = '';
    public $cedula = '';

    public $terminos = '';
    public $observaciones = '';





    protected $rules = [
        'numeroIdentificacion' => 'required|string|min:3',
        'id_barrio' => 'required',
        'direccion' => 'required|string|min:3',
        'accion_comunal' => 'file|mimes:pdf,jpeg,png,jpg|max:10240', // Valida cada archivo individualmente
        'electoral' => 'file|mimes:pdf,jpeg,png,jpg|max:10240', // Valida cada archivo individualmente
        'sisben' => 'file|mimes:pdf,jpeg,png,jpg|max:10240', // Valida cada archivo individualmente
        'cedula' => 'file|mimes:pdf,jpeg,png,jpg|max:10240', // Valida cada archivo individualmente
        'terminos' => 'required',
        'observaciones' => 'required|string',
    ];
    protected $messages = [
        'numeroIdentificacion.required' => 'El campo número de identificación es obligatorio.',
        'numeroIdentificacion.min' => 'El campo número de identificación debe tener al menos 3 caracteres.',
        'id_barrio.required' => 'El campo barrio es obligatorio.',
        'direccion.required' => 'El campo dirección es obligatorio.',
        'direccion.min' => 'El campo dirección debe tener al menos 3 caracteres.',
        'accion_comunal.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, png, jpg',
        'accion_comunal.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'electoral.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, png, jpg',
        'electoral.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'sisben.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, png, jpg',
        'sisben.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'cedula.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, png, jpg',
        'cedula.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'terminos.required' => 'El campo términos es obligatorio.',
        'observaciones.required' => 'El campo observaciones es obligatorio.',
        'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
    ];

    public function save()
    {

        $userId = auth()->id();

        // Verificar si el usuario tiene una solicitud pendiente
        if (Solicitud::hasPendingRequest($userId)) {
            // session()->flash('error', 'No puedes crear otra solicitud mientras tengas una en estado Pendiente.');
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Existe una solicitud pendiente.', text: 'No puedes crear otra solicitud mientras tengas una en estado Pendiente.', footer: '<a href="versolicitudes">Ver mis solicitudes</a>');
            return;
        }

        // Verificar si el usuario tiene una solicitud aprobada que no esté cerca de expirar
        if (Solicitud::hasApprovedRequest($userId) && !Solicitud::isApprovedRequestExpiring($userId)) {
            $this->dispatch('sweet-alert-good', icon: 'info', title: 'Existe una solicitud aprobada.', text: 'No puedes crear otra solicitud hasta que tu solicitud aprobada esté cerca de expirar.', footer: '<a href="versolicitudes">Ver mis solicitudes</a>');
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
        ];

        // Crear un array para almacenar las rutas de los archivos procesados
        $filePaths = [];

        foreach ($files as $key => $file) {
            if ($file) {
                // Obtener el nombre original del archivo
                $originalName = $file->getClientOriginalName();
                // Obtener la extensión del archivo
                $extension = $file->getClientOriginalExtension();
                // Crear un nombre único: nombre original + fecha y hora
                $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . now()->format('Ymd_His') . '.' . $extension;
                // Guardar el archivo en la carpeta específica según el tipo de archivo
                $path = $file->storeAs($key, $fileName, 'public');
                // Almacenar la ruta del archivo en el array
                $filePaths[$key] = $path;
            } else {
                $filePaths[$key] = null; // No se subió archivo
            }
        }

        // Crear una nueva solicitud y guardar las rutas de los archivos en la base de datos
        Solicitud::create([
            'user_id' => $userId,
            'numeroIdentificacion' => $this->numeroIdentificacion,
            'id_barrio' => $this->id_barrio,
            'direccion' => $this->direccion,
            'accion_comunal' => $filePaths['accion_comunal'],
            'electoral' => $filePaths['electoral'],
            'sisben' => $filePaths['sisben'],
            'cedula' => $filePaths['cedula'],
            'observaciones' => $this->observaciones,
            'terminos' => $this->terminos,
            'estado_id' => 1, // Estado inicial de 'Pendiente'
        ]);

        // Mostrar mensaje de éxito
        // session()->flash('message', 'Solicitud creada exitosamente.');
        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Solicitud creada exitosamente.', text: 'Tu solicitud ha sido enviada correctamente.', footer: '<a href="versolicitudes">Ver mis solicitudes</a>');


        // Resetear el formulario
        $this->reset();
    }





    public function render()
    {
        // Obtener el usuario autenticado
        $user = User::find(auth()->id());
        $barrios = Barrio::all();

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
