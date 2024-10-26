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
                'nombreEstado' => 'Nueva',
                'descripcion' => 'Verde para todas las solicitudes nuevas.',
                'color' => 'azul'
            ],
            [
                'nombreEstado' => 'Aceptado',
                'descripcion' => 'verde para todas las solicitudes aceptadas.',
                'color' => 'verde'
            ],
            [
                'nombreEstado' => 'Rechazado',
                'descripcion' => 'Rojo para todas las solicitudes rechazadas.',
                'color' => 'rojo'
            ],
        ];

        DB::table('estados')->insert($estados);
    }
}
