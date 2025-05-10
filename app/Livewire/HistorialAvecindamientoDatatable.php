<?php
namespace App\Livewire;

use App\Models\SolicitudAvecindamiento;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class HistorialAvecindamientoDatatable extends DataTableComponent
{
    protected $model = SolicitudAvecindamiento::class;
    public array $perPageAccepted = [10, 20, 50, 100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setSingleSortingStatus(false);
    }

    public function mount()
    {
        if (!auth()->user()->can('solicitudes')) {
            abort(403, 'No tienes acceso a esta página.');
        }
    }

    public function builder(): Builder
    {
        $query = SolicitudAvecindamiento::query();

        // Verificar el rol del usuario autenticado
        $query->whereIn('estado_id', [2, 3, 5]);

        // Filtrar por estados específicos y cargar relaciones necesarias
        return $query->with(['user', 'barrio', 'direccion']);
    }

    public function getIconByExtension($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'pdf':
                return 'fa-file-pdf';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'fa-file-image'; // Ícono para imágenes
            default:
                return 'fa-file';
        }
    }

    public function formatFileLink($file)
    {
        if ($file) {
            $icon = $this->getIconByExtension($file);
            $fileName = basename($file); // Obtener el nombre del archivo

            // Definir color basado en la extensión del archivo
            $color = 'blue'; // Valor por defecto
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $color = 'red'; // Cambiar a rojo para PDF
            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $color = 'blue'; // Cambiar a azul para imágenes
            }

            return "<a href='/storage/$file' target='_blank' title='$fileName'>
                      <i class='fas $icon fa-2x' style='color: $color;'></i>$fileName
                  </a>";
        }
        return 'Sin archivo';
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Usuario", "user_id")
                ->format(fn($value, $row) => $row->user ? $row->user->name_completo : 'Usuario no asignado')
                ->sortable()
                ->searchable(),
            Column::make("Número de Identificación", "numeroIdentificacion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Barrio", "barrio.nombreBarrio")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Dirección", "direccion")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Estado", "estado.nombreEstado")
                ->sortable()
                ->searchable()
                ->collapseOnMobile()
                ->format(function ($value, $row) {
                    switch ($value) {
                        case 'Pendiente':
                            return '<span style="background-color: #FFC107; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">Pendiente</span>';
                        case 'Procesando':
                            return '<span style="background-color: #28A745; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">Procesando</span>';
                        case 'No completado':
                            return '<span style="background-color: #DC3545; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">No completado</span>';
                        case 'En proceso':
                            return '<span style="background-color: #17A2B8; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">En proceso</span>';
                        default:
                            return '<span style="background-color: #6c757d; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">' . $value . '</span>';
                    }
                })
                ->html(), // Activa la renderización del HTML
            Column::make("Comunal", "accion_comunal")
                ->format(fn($value, $row) => $this->formatFileLink($row->accion_comunal))
                ->html() // Importante: Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("Electoral", "electoral")
                ->format(fn($value, $row) => $this->formatFileLink($row->electoral))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("_Sisben_", "sisben")
                ->format(fn($value, $row) => $this->formatFileLink($row->sisben))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("_Cédula_", "cedula")
                ->format(fn($value, $row) => $this->formatFileLink($row->cedula))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("_Recibo_", "recibo")
                ->format(fn($value, $row) => $this->formatFileLink($row->recibo))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Tipo persona a cargo", "tipo_persona_cargo")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("persona a cargo", "nombre_persona_cargo")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Doumento de persona a cargo", "documento_persona_cargo")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Fecha de Actualización", "updated_at")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.viewValidation', ['row' => $row])
                ),
        ];
    }
}
