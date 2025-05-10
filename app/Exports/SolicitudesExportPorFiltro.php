<?php

namespace App\Exports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SolicitudesExportPorFiltro implements FromQuery, WithMapping, WithHeadings, WithChunkReading
{
    protected $desde;
    protected $hasta;

    public function __construct($desde, $hasta)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
    }

    public function query()
    {
        return Solicitud::with(['user', 'barrio', 'estado', 'actualizador', 'validaciones'])
            ->when($this->desde, fn($q) => $q->where('created_at', '>=', $this->desde))
            ->when($this->hasta, fn($q) => $q->where('created_at', '<=', $this->hasta));
    }

    public function map($solicitud): array
    {
        $primeraValidacion = $solicitud->validaciones->first();

        return [
            $solicitud->id,
            $solicitud->created_at->format('Y-m-d H:i'),
            $solicitud->fecha_emision ?? 'Sin emitir',
            $primeraValidacion ? $primeraValidacion->created_at->format('Y-m-d H:i') : 'Sin validar',
            $solicitud->direccion,
            $solicitud->nombre_completo,
            $solicitud->numeroIdentificacion,
            optional($solicitud->user)->telefonoContacto,
            optional($solicitud->barrio)->nombreBarrio,
            optional($solicitud->barrio)->tipoUnidad,
            optional($solicitud->barrio)->zona,
            optional($solicitud->estado)->nombreEstado,
            optional($solicitud->actualizador)->codigo,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha Creación',
            'Fecha de Emisión',
            'Fecha de Validación',
            'Dirección',
            'Nombre Completo',
            'Identificación',
            'Teléfono',
            'Barrio',
            'Tipo Unidad',
            'Zona',
            'Estado',
            'Validador',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
