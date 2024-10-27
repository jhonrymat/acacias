<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UsersDatatable extends DataTableComponent
{
    protected $model = User::class;

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

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Nombre completo")
                ->label(fn($row) => "{$row->name} {$row->nombre_2} {$row->apellido_1} {$row->apellido_2}")
                ->html(), // Enable HTML if needed
            Column::make("Email", "email")
                ->sortable(),
            Column::make("TelefonoContacto", "telefonoContacto")
                ->sortable(),
            Column::make("NumeroIdentificacion", "numeroIdentificacion")
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
