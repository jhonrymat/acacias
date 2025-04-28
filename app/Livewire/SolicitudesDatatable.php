<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Solicitud;
use App\Models\Anulacion;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class SolicitudesDatatable extends DataTableComponent
{
    protected $model = Solicitud::class;
    protected $listeners = ['Updated' => '$refresh']; // Refrescar la tabla cuando se actualiza un tenant

    public ?int $searchFilterDebounce = 600;
    public array $perPageAccepted = [10, 20, 50, 100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setSingleSortingStatus(false);

        $this->setTableWrapperAttributes([
            'class' => 'max-h-56 md:max-h-72 lg:max-h-96 overflow-y-scroll',
        ]);
        $this->setTheadAttributes([
            'class' => 'sticky top-0 '
        ]);
    }
    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        $userId = auth()->id(); // Obtén el ID del usuario autenticado
        return Solicitud::query()->where('user_id', $userId); // Filtra las solicitudes solo para el usuario autenticado
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
                ->searchable()
                ->collapseAlways(),
            Column::make("Usuario", "user_id")
                ->format(fn($value, $row) => $row->user ? $row->user->name : 'Usuario no asignado')
                ->sortable()
                ->searchable(),
            Column::make("Identificación", "numeroIdentificacion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),

            Column::make("id_barrio")
                ->format(fn($value, $row) => strtolower($row->barrio->zona) . ' ' . ucfirst($row->barrio->nombreBarrio) . ' - ' . $row->barrio->tipoUnidad . ' ' . $row->barrio->codigoNumero)
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("Direccion", "direccion")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Creado", "created_at")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),

            // Agregar columnas para los nuevos archivos (accion_comunal, electoral, sisben, cedula)
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
            Column::make("Observaciones", "observaciones")
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
                        case 'no completado':
                            return '<span style="background-color: #DC3545; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">no completado</span>';
                        case 'En proceso':
                            return '<span style="background-color: #17A2B8; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">En proceso</span>';
                        default:
                            return '<span style="background-color: #6c757d; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">' . $value . '</span>';
                    }
                })
                ->html(), // Activa la renderización del HTML
            Column::make("Certificado")
                ->label(
                    fn($row) => view('livewire.view', ['row' => $row])
                ),
        ];
    }
}
