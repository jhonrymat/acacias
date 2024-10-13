<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoblacionSeeder extends Seeder
{
    public function run()
    {
        $poblaciones = [
            ['nombrePoblacion' => 'Afrocolombiano, Palenquero, Raizal'],
            ['nombrePoblacion' => 'Habitante de la calle'],
            ['nombrePoblacion' => 'Madre cabeza de familia'],
            ['nombrePoblacion' => 'Pobreza extrema (SISBEN 1)'],
            ['nombrePoblacion' => 'Víctima de la violencia'],
            ['nombrePoblacion' => 'Privado de la libertad'],
            ['nombrePoblacion' => 'Desplazado'],
            ['nombrePoblacion' => 'Indígena'],
            ['nombrePoblacion' => 'LGTBI'],
            ['nombrePoblacion' => 'Rom o Gitano'],
            ['nombrePoblacion' => 'Ninguna'],
            ['nombrePoblacion' => 'Otra'],
        ];

        DB::table('poblacion')->insert($poblaciones);
    }
}
