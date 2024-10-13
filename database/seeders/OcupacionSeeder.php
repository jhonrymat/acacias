<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OcupacionSeeder extends Seeder
{
    public function run()
    {
        $ocupaciones = [
            ['nombreOcupacion' => 'Desempleado'],
            ['nombreOcupacion' => 'Empleado'],
            ['nombreOcupacion' => 'Estudiante'],
            ['nombreOcupacion' => 'Funcionario Público'],
            ['nombreOcupacion' => 'Ama de Casa'],
            ['nombreOcupacion' => 'Miembro de Fuerzas Militares'],
            ['nombreOcupacion' => 'Médico'],
            ['nombreOcupacion' => 'Enfermero(a)'],
            ['nombreOcupacion' => 'Ingeniero(a)'],
            ['nombreOcupacion' => 'Abogado(a)'],
            ['nombreOcupacion' => 'Administrador(a)'],
            ['nombreOcupacion' => 'Veterinario(a)'],
            ['nombreOcupacion' => 'Contador(a)'],
            ['nombreOcupacion' => 'Técnico(a)'],
            ['nombreOcupacion' => 'Plomero(a)'],
            ['nombreOcupacion' => 'Electricista'],
            ['nombreOcupacion' => 'Chofer/Conductor'],
            ['nombreOcupacion' => 'Agricultor(a)'],
            ['nombreOcupacion' => 'Comerciante'],
            ['nombreOcupacion' => 'Docente/Profesor(a)'],
        ];

        DB::table('ocupacion')->insert($ocupaciones);
    }
}
