<?php

namespace App\Livewire;

use App\Models\Solicitud;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\SolicitudesExportPorFiltro;
use App\Exports\SolicitudesExportSeleccionadas;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

class SolicitudesExportTable extends DataTableComponent
{
    public array $selected = [];
    protected $listeners = ['exportarTodo' => 'exportarTodoFiltrado'];


    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setBulkActions([
                'exportarSeleccionadas' => 'Exportar seleccionadas',
                'exportarTodoFiltrado' => 'Exportar todo', // 👈 AÑADIDO
            ]);
    }

    public function builder(): Builder
    {
        return Solicitud::query()
            ->with(['user', 'barrio', 'estado', 'actualizador']);
    }



    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Fecha Creación', 'created_at')
                ->sortable()
                ->format(fn($value) => $value->format('Y-m-d H:i'))
                ->searchable(),
            Column::make('Dirección', 'direccion')
                ->sortable()
                ->searchable(),
            Column::make("Usuario", "user_id")
                ->format(fn($value, $row) => $row->user ? $row->user->name : 'Usuario no asignado')
                ->sortable()
                ->searchable(),
            Column::make("Identificación", "numeroIdentificacion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
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
        ];
    }

    public function filters(): array
    {
        return [
            DateTimeFilter::make('desde')
                ->filter(fn($q, $value) => $q->where('solicitudes.created_at', '>=', $value)),

            DateTimeFilter::make('hasta')
                ->filter(fn($q, $value) => $q->where('solicitudes.created_at', '<=', $value)),
        ];
    }



    public function exportarTodoFiltrado()
    {
        $desde = $this->getAppliedFilterWithValue('desde');
        $hasta = $this->getAppliedFilterWithValue('hasta');

        if (!$desde || !$hasta) {
            $this->dispatch('sweet-alert-good', icon: 'success', title: 'Uppss..!!.', text: 'Debes aplicar el filtro de fechas antes de exportar.');
            return;
        }

        return Excel::download(
            new SolicitudesExportPorFiltro($desde, $hasta),
            'solicitudes-filtradas.xlsx'
        );
    }
    public function exportarSeleccionadas()
    {
        $ids = $this->getSelected();

        if (count($ids) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'success', title: 'Uppss..!!.', text: 'Debes seleccionar al menos una solicitud.');
            return;
        }

        return Excel::download(new SolicitudesExportSeleccionadas($ids), 'solicitudes.xlsx');
    }
}
