<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ValidadoresDatatable extends DataTableComponent
{
    protected $model = User::class;

    protected $listeners = ['Updated' => '$refresh']; // Refrescar la tabla cuando se actualiza un tenant

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // Select additional fields for concatenating the full name
        $this->setAdditionalSelects([
            'users.name as name',
            'users.nombre_2 as nombre_2',
            'users.apellido_1 as apellido_1',
            'users.apellido_2 as apellido_2',
        ]);
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        $query = User::query()->with('roles'); // Carga la relación roles

        // Filtrar según el rol del usuario autenticado
        if (Auth::user()->hasRole('admin')) {
            // Mostrar solos los usuarios con el rol de validador1 o validador2
            $query->whereHas('roles', function ($query) {
                $query->whereIn('name', ['validador1', 'validador2']);
            });
        }

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Nombre completo")
                ->label(fn($row) => "{$row->name} {$row->nombre_2} {$row->apellido_1} {$row->apellido_2}")
                ->html(),
            Column::make("Email", "email")
                ->sortable()
                ->collapseAlways(),
            Column::make("TelefonoContacto", "telefonoContacto")
                ->collapseAlways()
                ->sortable(),
            Column::make("NumeroIdentificacion", "numeroIdentificacion")
                ->sortable()
                ->collapseAlways(),
            Column::make("Codigo", "codigo")
                ->sortable()
                ->searchable(),
            Column::make("Rol")
                ->label(fn($row) => $row->roles->pluck('name')->join(', ')), // Muestra los roles separados por coma
            Column::make("Creado", "created_at")
                ->sortable()
                ->collapseAlways(),
            Column::make("Actualizado", "updated_at")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.editValidador', ['row' => $row])
                ),
        ];
    }
}
