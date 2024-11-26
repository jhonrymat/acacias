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
            ->where('actualizado_por', auth()->id()) // Filtramos por el usuario actual
            ->whereIn('estado_id', [2, 3]) // Filtramos por estados específicos
            ->with(['user', 'barrio', 'direccion']); // Cargamos relaciones solo cuando sean necesarias
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Usuario", "user.name")
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
                        case 'Aprobada':
                            return '<span style="background-color: #28A745; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">Aprobada</span>';
                        case 'Rechazada':
                            return '<span style="background-color: #DC3545; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">Rechazada</span>';
                        case 'En proceso':
                            return '<span style="background-color: #17A2B8; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">En proceso</span>';
                        default:
                            return '<span style="background-color: #6c757d; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">' . $value . '</span>';
                    }
                })
                ->html(), // Activa la renderización del HTML
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
