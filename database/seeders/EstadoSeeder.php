<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;

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
                'nombreEstado' => 'En proceso',
                'descripcion' => 'La solicitud está siendo revisada o procesada actualmente',
                'color' => '#17A2B8'
            ],
        ];

        DB::table('estados')->insert($estados);
    }
}
