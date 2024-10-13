<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Barrio;

class BarrioDatatable extends DataTableComponent
{

    protected $model = Barrio::class;
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
            Column::make("Nombre de barrio", "nombreBarrio")
                ->sortable()
                ->searchable(),
                Column::make("Tipo unidad", "tipoUnidad")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Unidad", "codigoNumero")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Zona", "zona")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.acciones', ['row' => $row])
                )
                ->collapseOnMobile(),

        ];
    }
}
