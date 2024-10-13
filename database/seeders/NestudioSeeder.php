<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NestudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nivelesEstudio = [
            ['nivelEstudio' => 'Bachillerato'],
            ['nivelEstudio' => 'Especialización'],
            ['nivelEstudio' => 'Master'],
            ['nivelEstudio' => 'Phd'],
            ['nivelEstudio' => 'Primaria'],
            ['nivelEstudio' => 'Profesional'],
            ['nivelEstudio' => 'Tecnológico'],
            ['nivelEstudio' => 'Técnico'],
        ];

        DB::table('nestudios')->insert($nivelesEstudio);
    }
}
