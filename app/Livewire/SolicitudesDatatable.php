<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Solicitud;
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
            case 'doc':
            case 'docx':
                return 'fa-file-word';
            case 'xls':
            case 'xlsx':
                return 'fa-file-excel';
                case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                        return 'fa-file-image'; // Ícono para imágenes
                    case 'zip':
                    case 'rar':
                        return 'fa-file-archive'; // Ícono para archivos comprimidos
                   
            default:
                return 'fa-file';
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Usuario", "user_id")
                ->format(fn($value, $row) => $row->user ? $row->user->name : 'Usuario no asignado')
                ->sortable()
                ->searchable(),
            Column::make("# Identificación", "numeroIdentificacion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Barrio", "barrio.nombreBarrio")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Direccion", "direccion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Creado", "created_at")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),

            Column::make("Anexos", "evidenciaPDF")
                ->format(function ($value, $row) {
                    $files = json_decode($value); // Convierte el valor JSON a un array
                    if (is_array($files)) {
                        return implode(' ', array_map(function ($file) {
                            $icon = $this->getIconByExtension($file);
                            $fileName = basename($file); // Obtener el nombre del archivo
                            return "<a href='/storage/$file' target='_blank' title='$fileName'><i class='fas $icon fa-2x' style='color: blue';></i> $fileName</a>";
                        }, $files));
                    }
                    return 'Sin archivos';
                })
                ->html() // Importante: Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),

            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.view', ['row' => $row])
                )
                ->collapseOnMobile(),
        ];
    }
}
