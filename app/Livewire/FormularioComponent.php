<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Barrio;
use App\Models\Genero;
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
    public $evidenciaPDF = [];
    public $terminos = '';
    public $observaciones = '';





    protected $rules = [
        'numeroIdentificacion' => 'required|string|min:3',
        'id_barrio' => 'required',
        'direccion' => 'required|string|min:3',
        'evidenciaPDF' => 'required', // Asegúrate de que el array esté presente
        'evidenciaPDF.*' => 'file|mimes:pdf,jpeg,png,jpg,doc,docx|max:10240', // Valida cada archivo individualmente
        'terminos' => 'required',
        'observaciones' => 'required|string',
    ];
    protected $messages = [
        'numeroIdentificacion.required' => 'El campo número de identificación es obligatorio.',
        'numeroIdentificacion.min' => 'El campo número de identificación debe tener al menos 3 caracteres.',
        'id_barrio.required' => 'El campo barrio es obligatorio.',
        'direccion.required' => 'El campo dirección es obligatorio.',
        'direccion.min' => 'El campo dirección debe tener al menos 3 caracteres.',
        'evidenciaPDF.required' => 'El campo evidencia es obligatorio.',
        'evidenciaPDF.file' => 'El campo evidencia debe ser un archivo.',
        'evidenciaPDF.mimes' => 'El campo evidencia debe ser un archivo de tipo: pdf, jpeg, png, jpg, doc, docx.',
        'evidenciaPDF.max' => 'El campo evidencia no debe ser mayor a 10MB.',
        'terminos.required' => 'El campo términos es obligatorio.',
        'observaciones.required' => 'El campo observaciones es obligatorio.',
        'observaciones.string' => 'El campo observaciones debe ser una cadena de texto.',
    ];

    public function save()
    {
        // Validate form data
        $validatedData = $this->validate();

        // Si hay archivos adjuntos
        if ($this->evidenciaPDF) {
            // Crear un array para almacenar las rutas de los archivos
            $evidenciaPDFPaths = [];

            // Recorrer cada archivo y guardarlo
            foreach ($this->evidenciaPDF as $anexo) {
                // Obtener el nombre original del archivo
                $originalName = $anexo->getClientOriginalName();

                // Obtener la extensión del archivo
                $extension = $anexo->getClientOriginalExtension();

                // Crear un nombre único: nombre original + fecha y hora
                $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . now()->format('Ymd_His') . '.' . $extension;

                // Guardar el archivo en la carpeta 'evidenciaPDF' y obtener su ruta
                $path = $anexo->storeAs('evidenciaPDF', $fileName, 'public');

                // Almacenar la ruta del archivo
                $evidenciaPDFPaths[] = $path;
            }
        }
        // Create a new solicitud
        Solicitud::create([
            'user_id' => auth()->id(),
            'numeroIdentificacion' => $this->numeroIdentificacion,
            'id_barrio' => $this->id_barrio, // Assuming barrio is 1 for now, replace with actual value
            'direccion' => $this->direccion,
            'evidenciaPDF' => json_encode($evidenciaPDFPaths),  // Guardar las rutas de los archivos en la base de datos
            'observaciones' => $this->observaciones,
            'terminos' => $this->terminos,
        ]);

        // Show success message
        session()->flash('message', 'Solicitud creada exitosamente.');

        // Optionally, reset the form
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
