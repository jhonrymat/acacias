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
            Column::make("Evidencia PDF", "evidenciaPDF")
                ->label(
                    fn($row) => $row->evidenciaPDF
                    ? '<a href="' . Storage::url($row->evidenciaPDF) . '" target="_blank" class="text-blue-500">Ver archivo</a>'
                    : 'No disponible'
                )
                ->html()
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
