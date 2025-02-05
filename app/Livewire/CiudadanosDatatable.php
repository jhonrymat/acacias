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

    protected $listeners = ['refresh-data-table' => '$refresh'];


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query()
            ->select(['id', 'name', 'nombre_2', 'apellido_1', 'apellido_2', 'email', 'telefonoContacto', 'numeroIdentificacion', 'ciudadExpedicion', 'fechaNacimiento', 'created_at', 'updated_at'])
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['admin', 'validador1', 'validador2']);
            });
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Nombre Completo")
                ->label(fn($row) => trim(
                    $row->name . ' ' .
                    ($row->nombre_2 ?? '') . ' ' .
                    $row->apellido_1 . ' ' .
                    ($row->apellido_2 ?? '')
                )),


            Column::make("Email", "email")
                ->searchable()
                ->sortable()
                ->collapseAlways(),
            Column::make("TelefonoContacto", "telefonoContacto")
                ->searchable()
                ->collapseAlways()
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
                ->collapseAlways()
                ->sortable(),
            Column::make("Updated at", "updated_at")
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
