<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TsolicitanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tsolicitantes = [
            ['tipoSolicitante' => 'Ciudadano'],
            ['tipoSolicitante' => 'Extranjero'],
            ['tipoSolicitante' => 'Organización'],
        ];

        DB::table('tsolicitantes')->insert($tsolicitantes);
    }
}
