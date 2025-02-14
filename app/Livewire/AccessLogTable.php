<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AccessLog;

class AccessLogTable extends DataTableComponent
{
    protected $model = AccessLog::class;
    public array $perPageAccepted = [10, 20, 50, 100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('logged_in_at', 'desc');
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Usuario', 'user.name')->searchable()->sortable(),
            Column::make('IP', 'ip_address')->searchable()->sortable(),
            Column::make('Navegador', 'user_agent')->searchable()->collapseAlways(),
            Column::make('Inicio de Sesión', 'logged_in_at')->sortable(),
            Column::make('Cierre de Sesión', 'logged_out_at')->sortable(),
            Column::make('Fuera de Horario', 'out_of_working_hours')
                ->format(fn($value) => $value ? '✅ Sí' : '❌ No')
                ->sortable(),
        ];
    }
}
