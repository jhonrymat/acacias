<?php
namespace App\Livewire;

use App\Models\Solicitud;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class HistorialSolicitudesDatatable extends DataTableComponent
{
    protected $model = Solicitud::class;
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
        return Solicitud::query()
            ->where('estado_id', 2) // Solo estados aceptada o rechazada
            ->orWhere('estado_id',3)
            ->where('actualizado_por', auth()->id()) // Solo las actualizadas por el usuario actual
            ->with(['user', 'barrio', 'direccion']); // Carga las relaciones
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
                ->searchable(),
            Column::make("Dirección", "direccion")
                ->sortable()
                ->searchable(),
            Column::make("Estado", "estado_id")
                ->format(function ($value, $row) {
                    $clase = match ((int)$value) {
                        2 => 'bg-blue-500 text-black',
                        3 => 'bg-red-500 text-white',
                        default => 'bg-gray-500 text-white',
                    };
                    $texto = match ((int)$value) {
                        2 => 'Aceptada',
                        3 => 'Rechazada',
                        default => 'Desconocido',
                    };
                    return <<<HTML
                        <span class="px-4 py-2 text-sm rounded cursor-pointer $clase">
                            $texto
                        </span>
                    HTML;
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make("Fecha de Actualización", "updated_at")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
        ];
    }
}
