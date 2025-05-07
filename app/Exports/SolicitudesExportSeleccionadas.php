<?php

namespace App\Exports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SolicitudesExportSeleccionadas implements FromCollection, WithHeadings
{
    protected $ids;

    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return Solicitud::with(['user', 'barrio', 'estado', 'actualizador', 'validaciones'])
            ->whereIn('id', $this->ids)
            ->get()
            ->map(function ($solicitud) {
                return [
                    'ID' => $solicitud->id,
                    'Fecha Creación' => $solicitud->created_at->format('Y-m-d H:i'),

                    'Dirección' => $solicitud->direccion,
                    'Nombre Completo' => $solicitud->nombre_completo,
                    'Identificación' => $solicitud->numeroIdentificacion,
                    'Teléfono' => optional($solicitud->user)->telefonoContacto,
                    'Barrio' => optional($solicitud->barrio)->nombreBarrio,
                    'Tipo Unidad' => optional($solicitud->barrio)->tipoUnidad,
                    'Zona' => optional($solicitud->barrio)->zona,
                    'Estado' => optional($solicitud->estado)->nombreEstado,
                    'Validador' => optional($solicitud->actualizador)->codigo,
                    'Fecha de Emisión' => $solicitud->fecha_emision
                        ? date('Y-m-d', strtotime($solicitud->fecha_emision))
                        : 'Sin emitir',
                    'Fecha de Validación' => optional($solicitud->validaciones->first())->created_at
                        ? optional($solicitud->validaciones->first()->created_at)->format('Y-m-d H:i')
                        : 'Sin validar',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha Creación',
            'Dirección',
            'Nombre Completo',
            'Identificación',
            'Teléfono',
            'Barrio',
            'Tipo Unidad',
            'Zona',
            'Estado',
            'Validador',
            'Fecha de Emisión',
            'Fecha de Validación'
        ];
    }
}
