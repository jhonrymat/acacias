<?php

namespace App\Livewire;

use App\Models\Solicitud;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class SolicitudDatatable extends DataTableComponent
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
            Column::make("Usuario", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Número de Identificación", "numeroIdentificacion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Barrio", "barrio.nombreBarrio")
                ->sortable()
                ->searchable() // Relacionado con la tabla de barrios
                ->collapseOnMobile(),
            Column::make("Dirección", "direccion")
                ->sortable()
                ->searchable() // Relacionado con la tabla de direcciones
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
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.acciones', ['row' => $row])
                )->collapseOnMobile(),
        ];
    }
}
