<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    public function run()
    {
        $generos = [
            ['nombreGenero' => 'Masculino'],
            ['nombreGenero' => 'Femenino'],
            ['nombreGenero' => 'N/A Persona jurídica'],
            ['nombreGenero' => 'Otro'],
        ];

        DB::table('generos')->insert($generos);
    }
}
