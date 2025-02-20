<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ActivityLog;

class ActivityLogTable extends DataTableComponent
{
    protected $model = ActivityLog::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Usuario', 'user.name')->searchable()->sortable(),
            Column::make('Acción', 'action')->searchable()->sortable(),
            Column::make('Modelo Afectado', 'model_type')->searchable()->collapseAlways(),
            Column::make('ID del Registro', 'model_id')->searchable()->sortable(),
            Column::make('Fecha y Hora', 'created_at')->sortable(),
            Column::make("Updated at", "updated_at")->sortable()->collapseAlways(),
        ];
    }
}
