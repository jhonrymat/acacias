<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CiudadanosDatatable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        // Obtener la consulta base de Solicitud
        $query = User::query();

        // Filtrar según el rol del usuario autenticado
        if (Auth::user()->hasRole('admin')) {
            // Mostrar solos los usuarios con el rol de user
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'user');
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
            Column::make("primer nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("segundo nombre", "nombre_2")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("primer apellido", "apellido_1")
                ->sortable()
                ->searchable(),
            Column::make("segundo apellido", "apellido_2")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Email", "email")
                ->searchable()
                ->sortable()
                ->collapseAlways(),
            Column::make("TelefonoContacto", "telefonoContacto")
                ->searchable()
                ->sortable(),
            Column::make("NumeroIdentificacion", "numeroIdentificacion")
                ->searchable()
                ->sortable(),
            Column::make("CiudadExpedicion", "ciudadExpedicion")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("FechaNacimiento", "fechaNacimiento")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
        ];
    }
}
