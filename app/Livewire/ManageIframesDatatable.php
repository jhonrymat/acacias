<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RoleIframe;

class ManageIframesDatatable extends DataTableComponent
{
    protected $model = RoleIframe::class;
    protected $listeners = ['Updated' => '$refresh'];
    public ?int $searchFilterDebounce = 600;
    public array $perPageAccepted = [10, 20, 50, 100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function formatAttributes($value)
    {
        $attributes = json_decode($value, true) ?? [];

        if (empty($attributes)) {
            return '<span class="text-gray-500">Sin atributos</span>';
        }

        return collect($attributes)
            ->map(fn($val, $key) => "<strong>$key:</strong> $val")
            ->implode('<br>');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Role", "role")
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Iframe title", "iframe_title")
                ->sortable(),
            Column::make("Iframe src", "iframe_src")
                ->collapseAlways()
                ->sortable(),
            Column::make("Atributos", "attributes")
                ->format(fn($value) => $this->formatAttributes($value))
                ->html()
                ->collapseAlways(),
            Column::make("Created at", "created_at")
                ->collapseOnMobile()
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->collapseAlways()
                ->sortable(),
            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.acciones', ['row' => $row])
                )->collapseAlways()
        ];
    }
}
