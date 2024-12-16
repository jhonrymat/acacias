<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstadoSeeder extends Seeder
{

    public function run()
    {
        $estados = [
            [
                'nombreEstado' => 'Pendiente',
                'descripcion' => 'La solicitud está en proceso y será validada lo más pronto posible. Te notificaremos una vez se complete la revisión.',
                'color' => '#FFC107'
            ],
            [
                'nombreEstado' => 'Procesando',
                'descripcion' => 'La solicitud fue revisada y validada exitosamente. Solo falta la emisión del certificado correspondiente.',
                'color' => '#85D17A'
            ],
            [
                'nombreEstado' => 'Rechazada',
                'descripcion' => 'La solicitud fue revisada, pero no cumplió con los requisitos necesarios y no pudo ser emitida.',
                'color' => '#DC3545'
            ],
            [
                'nombreEstado' => 'En revision',
                'descripcion' => 'La solicitud está siendo revisada o procesada actualmente',
                'color' => '#17A2B8'
            ],
            [
                'nombreEstado' => 'Emitido',
                'descripcion' => 'El certificado ha sido emitido (Vigente) y está disponible para su descarga desde el portal.',
                'color' => '#5BC0EB'
            ],
            [
                'nombreEstado' => 'Por vencer',
                'descripcion' => 'El certificado actual está próximo a vencer. Esta notificación se activa durante los últimos 15 días de validez.',
                'color' => '#F29423'
            ],
            [
                'nombreEstado' => 'Vencido',
                'descripcion' => 'El certificado ha expirado y deberá realizarse un nuevo proceso para obtener uno actualizado.',
                'color' => '#6C757D'
            ],
        ];

        DB::table('estados')->insert($estados);
    }
}
