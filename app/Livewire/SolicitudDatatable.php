<?php

namespace App\Livewire;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SolicitudDatatable extends DataTableComponent
{
    protected $model = Solicitud::class;
    protected $listeners = ['Updated' => '$refresh']; // Refrescar la tabla cuando se actualiza un tenant
    public ?int $searchFilterDebounce = 600;
    public array $perPageAccepted = [10, 20, 50, 100];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        // Configurar acciones masivas solo para el rol validador2
        if (Auth::user()->hasRole('validador2')) {
            $this->setBulkActions([
                'validarStatus' => 'Validar solicitudes',
                'rechazarStatus' => 'Rechazar solicitudes',
            ]);
        }

        $this->setDefaultSort('id', 'desc');
        $this->setSingleSortingStatus(false);
        // Configurar el mensaje personalizado según el rol
        if (Auth::user()->hasRole('validador1')) {
            $this->setEmptyMessage("No hay solicitudes pendientes de revisión. Como Validador 1.");
        } elseif (Auth::user()->hasRole('validador2')) {
            $this->setEmptyMessage("No hay solicitudes en espera de aprobación final. Como Validador 2.");
        } else {
            $this->setEmptyMessage("No hay registros para mostrar.");
        }
    }

    public function validarStatus()
    {
        // Obtén las filas seleccionadas
        $selectedRows = $this->getSelected();

        // Verificar si hay filas seleccionadas
        if (count($selectedRows) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'warning', title: 'Advertencia', text: 'Debe seleccionar al menos una fila.');
            return;
        }

        Solicitud::whereIn('id', $selectedRows)->update([
            'estado_id' => 5,
            'fecha_emision' => now(),
            'Validador2_id' => Auth::id()
        ]);

        $this->clearSelected();

        $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Estado actualizado para las filas seleccionadas.');


    }


    public function rechazarStatus()
    {
        // Obtén las filas seleccionadas
        $selectedRows = $this->getSelected();

        if (count($selectedRows) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'warning', title: 'Advertencia', text: 'Debe seleccionar al menos una fila.');
            return;
        }
        // Actualiza el estado de las filas seleccionadas
        Solicitud::whereIn('id', $selectedRows)->update([
            'estado_id' => 3,
            'fecha_emision' => now(),
            'Validador2_id' => Auth::id()
        ]);

        // Limpia la selección
        $this->clearSelected();

        // Opcional: envía un mensaje al usuario
        $this->dispatch('sweet-alert-good', icon: 'info', title: 'solicitudes rechazadas con exito', text: 'Estado actualizado para las filas seleccionadas.');


    }



    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        // Obtener la consulta base de Solicitud
        $query = Solicitud::query();

        // Filtrar según el rol del usuario autenticado
        if (Auth::user()->hasRole('validador1')) {
            // Mostrar solicitudes con estado "Pendiente" o "En revisión"
            $query->whereIn('estado_id', [1, 4]);
        } elseif (Auth::user()->hasRole('validador2')) {
            // Estado Procesando
            $query->where('estado_id', 2);
        }

        return $query;
    }


    public function getIconByExtension($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'pdf':
                return 'fa-file-pdf';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'fa-file-image'; // Ícono para imágenes
            default:
                return 'fa-file';
        }
    }

    public function formatFileLink($file)
    {
        if ($file) {
            $icon = $this->getIconByExtension($file);
            $fileName = basename($file); // Obtener el nombre del archivo

            // Definir color basado en la extensión del archivo
            $color = 'blue'; // Valor por defecto
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $color = 'red'; // Cambiar a rojo para PDF
            } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $color = 'blue'; // Cambiar a azul para imágenes
            }

            return "<a href='/storage/$file' target='_blank' title='$fileName'>
                      <i class='fas $icon fa-2x' style='color: $color;'></i>$fileName
                  </a>";
        }
        return 'Sin archivo';
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
            // mostrar el nombre de actualizado_por
            Column::make("Validado", "actualizador.name")
                ->sortable()
                ->searchable(),
            Column::make("Documento", "numeroIdentificacion")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make("id_barrio")
                ->format(fn($value, $row) => strtolower($row->barrio->zona) . ' ' . ucfirst($row->barrio->nombreBarrio) . ' - ' . $row->barrio->tipoUnidad . ' ' . $row->barrio->codigoNumero)
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Dirección", "direccion")
                ->sortable()
                ->searchable() // Relacionado con la tabla de direcciones
                ->collapseAlways(),
            // Agregar columnas para los nuevos archivos (accion_comunal, electoral, sisben, cedula)
            Column::make("Comunal", "accion_comunal")
                ->format(fn($value, $row) => $this->formatFileLink($row->accion_comunal))
                ->html() // Importante: Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("Electoral", "electoral")
                ->format(fn($value, $row) => $this->formatFileLink($row->electoral))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("_Sisben_", "sisben")
                ->format(fn($value, $row) => $this->formatFileLink($row->sisben))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),

            Column::make("_Cédula_", "cedula")
                ->format(fn($value, $row) => $this->formatFileLink($row->cedula))
                ->html() // Permite la interpretación del HTML en la columna
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
                        case 'Procesando':
                            return '<span style="background-color: #28A745; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">Procesando</span>';
                        case 'Rechazada':
                            return '<span style="background-color: #DC3545; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">Rechazada</span>';
                        case 'En proceso':
                            return '<span style="background-color: #17A2B8; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">En proceso</span>';
                        case 'En revision':
                            return '<span style="background-color: #17A2B8; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">En revisión</span>';
                        default:
                            return '<span style="background-color: #6c757d; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">' . $value . '</span>';
                    }
                })
                ->html(), // Activa la renderización del HTML


            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),

            Column::make("Acciones")
                ->label(
                    fn($row) => view('livewire.viewUser', ['row' => $row])
                ),
        ];
    }
}
