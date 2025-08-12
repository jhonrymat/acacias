<?php

namespace App\Livewire;
use Milon\Barcode\DNS2D;
use App\Models\Solicitud;
use App\Models\Validacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class SolicitudDatatable extends DataTableComponent
{
    protected $model = Solicitud::class;
    protected $listeners = [
        'Updated' => '$refresh',
        'aceptarTodasSolicitudes' => 'AceptarTodas',
        'rechazarTodasSolicitudes' => 'RechazarTodas'
    ]; // Escuchar el evento para aceptar todas las solicitudes
    public ?int $searchFilterDebounce = 600;
    public array $perPageAccepted = [10, 20, 50, 100];

    public $selectedRowId = null;

    // public $selectAll = false;

    public array $selectedRows = [];




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

        $this->setDefaultSort('id', 'asc');
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

    public function selectRow(int $rowId): void
    {
        $this->selectedRowId = $rowId;
    }


    public function isSelected($id)
    {
        return in_array($id, $this->getSelected());
    }




    public function validarStatus()
    {
        // Obtén las filas seleccionadas
        $this->selectedRows = $this->getSelected();

        // Verificar si hay filas seleccionadas
        if (count($this->selectedRows) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'warning', title: 'Advertencia', text: 'Debe seleccionar al menos una fila.');
            return;
        }

        // $this->dispatch('validarVulk', icon: 'success');
        $this->dispatch(
            'vulk',
            icon: 'info',
            title: '¿Estás seguro?',
            text: 'Vas a aceptar estas solicitudes'
        );
    }

    public function AceptarTodas()
    {
        // Asegurar que hay filas seleccionadas antes de proceder
        if (count($this->selectedRows) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'warning', title: 'Advertencia', text: 'Debe seleccionar al menos una fila para aceptar.');
            return;
        }

        DB::beginTransaction(); // Iniciar transacción

        try {
            foreach ($this->selectedRows as $solicitudId) {
                // Buscar la solicitud
                $solicitud = Solicitud::find($solicitudId);
                if (!$solicitud) {
                    throw new \Exception("Solicitud con ID {$solicitudId} no encontrada.");
                }

                // Generar URL del QR
                $baseUrl = config('app.url');
                $qrUrl = $baseUrl . '/qr/' . $solicitud->id . '/' . $solicitud->numeroIdentificacion;

                // Asegurar que la carpeta de almacenamiento exista
                $qrStoragePath = storage_path('app/public/qrs');
                if (!is_dir($qrStoragePath)) {
                    if (!mkdir($qrStoragePath, 0755, true) && !is_dir($qrStoragePath)) {
                        throw new \Exception('No se pudo crear el directorio para los QR.');
                    }
                }

                // Generar el código QR
                $barcode = new DNS2D();
                $qrImageContent = $barcode->getBarcodePNG($qrUrl, 'QRCODE', 10, 10);

                // Verificar si el QR se generó correctamente
                if (!$qrImageContent) {
                    throw new \Exception("No se pudo generar el código QR para la solicitud con ID {$solicitud->id}.");
                }

                // Guardar el QR en un archivo
                $qrPath = 'qrs/' . $solicitud->id . '.png';
                $qrFullPath = storage_path('app/public/' . $qrPath);
                file_put_contents($qrFullPath, base64_decode($qrImageContent));

                // Verificar si el archivo se guardó correctamente
                if (!file_exists($qrFullPath)) {
                    throw new \Exception("No se pudo guardar el código QR para la solicitud con ID {$solicitud->id}.");
                }

                // Buscar o crear la validación y actualizarla
                $validacion = Validacion::firstOrCreate(
                    ['id_solicitud' => $solicitud->id],
                    ['qr_url' => $qrPath]
                );

                $validacion->update(['qr_url' => $qrPath]);

                // Actualizar la solicitud en la base de datos
                $solicitud->update([
                    'estado_id' => 5,
                    'fecha_emision' => now(),
                    'Validador2_id' => Auth::id(),
                ]);

                // Enviar correo al usuario
                Mail::to($solicitud->user->email)->send(new \App\Mail\SolicitudEmitidaNotification($solicitud->id, $solicitud->user->name));
            }

            DB::commit(); // Si todo salió bien, confirmamos la transacción

            // Limpiar selección después de la actualización
            $this->clearSelected();
            $this->selectedRows = []; // Limpiar manualmente para evitar problemas

            // Notificar éxito
            $this->dispatch('Updated');
            $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Solicitudes aceptadas y códigos QR generados.');

        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios si hay error

            // Mostrar error
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: $e->getMessage());
        }
    }




    public function rechazarStatus()
    {
        // Obtén las filas seleccionadas
        $this->selectedRows = $this->getSelected();

        // Verificar si hay filas seleccionadas
        if (count($this->selectedRows) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'warning', title: 'Advertencia', text: 'Debe seleccionar al menos una fila.');
            return;
        }

        // $this->dispatch('validarVulk', icon: 'success');
        $this->dispatch(
            'decline',
            icon: 'info',
            title: '¿Estás seguro?',
            text: 'No completaras estas solicitudes estas solicitudes'
        );


    }

    public function RechazarTodas()
    {
        // Asegurar que hay filas seleccionadas antes de proceder
        if (count($this->selectedRows) === 0) {
            $this->dispatch('sweet-alert-good', icon: 'warning', title: 'Advertencia', text: 'Debe seleccionar al menos una fila para no completarla.');
            return;
        }

        DB::beginTransaction(); // Iniciar transacción

        try {
            foreach ($this->selectedRows as $solicitudId) {
                // Buscar la solicitud
                $solicitud = Solicitud::find($solicitudId);
                if (!$solicitud) {
                    throw new \Exception("Solicitud con ID {$solicitudId} no encontrada.");
                }

                // Actualiza el estado de las filas seleccionadas
                $solicitud->update([
                    'estado_id' => 3, // Estado de "Rechazado"
                    'fecha_emision' => now(),
                    'Validador2_id' => Auth::id()
                ]);

                $userName = $solicitud->user->name; // Nombre del usuario
                $userEmail = $solicitud->user->email; // Email del usuario

                // Enviar correo de rechazo
                Mail::to($userEmail)->send(new \App\Mail\SolicitudRechazadaNotification($solicitud->id, $userName));
            }

            DB::commit(); // Si todo salió bien, confirmamos la transacción

            // Limpiar selección después de la actualización
            $this->clearSelected();
            $this->selectedRows = []; // Limpiar manualmente para evitar problemas

            // Notificar éxito con el mensaje correcto
            $this->dispatch('Updated');
            $this->dispatch('sweet-alert-good', icon: 'success', title: 'Muy bien..!', text: 'Solicitudes No completado con éxito.');

        } catch (\Exception $e) {
            DB::rollBack(); // Revertir cambios si hay error

            // Mostrar error
            $this->dispatch('sweet-alert-good', icon: 'error', title: 'Error', text: $e->getMessage());
        }
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

    public function toggleFavorito($solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        if ($solicitud) {
            $solicitud->es_favorito = !$solicitud->es_favorito;
            $solicitud->save();
        }

        $this->dispatch('Updated');
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->format(
                    fn($value, $row) =>
                    "<span x-data=\"{}\"
                        @click=\"let row = \$el.closest('tr');
                                row.style.backgroundColor = (row.style.backgroundColor === 'rgb(191, 219, 254)') ? '' : '#bfdbfe';\"
                        style='cursor: pointer; text-decoration: underline; color: blue;'>
                        {$value}
                    </span>"
                )
                ->html(),
            Column::make("Favorito", "es_favorito")
                ->sortable()
                ->searchable()
                ->format(function ($value, $row) {
                    if ($value) {
                        return '<button wire:click="toggleFavorito(' . $row->id . ')" class="border-0 bg-transparent">
                                    <i class="fas fa-star" style="color: #FFC107; font-size: 20px;"></i>
                                </button>';
                    } else {
                        
                        return '<button wire:click="toggleFavorito(' . $row->id . ')" class="border-0 bg-transparent">
                                    <i class="far fa-star" style="color: #6c757d; font-size: 20px;"></i>
                                </button>';
                    }
                })
                ->html(), // Activa la renderización del HTML
            Column::make("Usuario", "user_id")
                ->format(fn($value, $row) => $row->user ? $row->user->name_completo : 'Usuario no asignado')
                ->sortable()
                ->searchable(),
            // mostrar el nombre de actualizado_por
            Column::make("Validado", "actualizador.name")
                ->sortable()
                ->searchable(),
            Column::make("Tipo", "user_id")
                ->format(fn($value, $row) => $row->user ? $row->user->tipoDocumento->tipoDocumento : 'Usuario no asignado')
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
            Column::make("_Recibo_", "recibo")
                ->format(fn($value, $row) => $this->formatFileLink($row->recibo))
                ->html() // Permite la interpretación del HTML en la columna
                ->sortable()
                ->searchable()
                ->collapseAlways(),
            Column::make("Observaciones", "observaciones")
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
                        case 'No completado':
                            return '<span style="background-color: #DC3545; color: white; padding: 4px 8px; text-align: center; border-radius: 5px;">No completado</span>';
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
