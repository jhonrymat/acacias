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
                'descripcion' => 'Este estado puede representar que la solicitud está esperando ser procesada.',
                'color' => '#FFC107'
            ],
            [
                'nombreEstado' => 'Aprobada',
                'descripcion' => ' Indica que la solicitud ha sido aprobada.',
                'color' => '#28A745'
            ],
            [
                'nombreEstado' => 'Rechazada',
                'descripcion' => 'La solicitud fue revisada y no fue aceptada.',
                'color' => '#DC3545'
            ],
            [
                'nombreEstado' => 'En revision',
                'descripcion' => 'La solicitud está siendo revisada o procesada actualmente',
                'color' => '#17A2B8'
            ],
            [
                'nombreEstado' => 'Emitido',
                'descripcion' => 'El cerificado fue emitido',
                'color' => '#28A745'
            ],
            [
                'nombreEstado' => 'Por vencer',
                'descripcion' => 'El certificado está por vencer',
                'color' => '#FFC107'
            ],
            [
                'nombreEstado' => 'Vencido',
                'descripcion' => 'El certificado ha vencido',
                'color' => '#DC3545'
            ],
        ];

        DB::table('estados')->insert($estados);
    }
}
