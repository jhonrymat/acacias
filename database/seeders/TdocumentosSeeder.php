<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TdocumentosSeeder extends Seeder
{
    public function run()
    {
        $documentos = [
            ['tipoDocumento' => 'Registro civil'],
            ['tipoDocumento' => 'Tarjeta de identidad'],
            ['tipoDocumento' => 'Cédula de ciudadanía'],
            ['tipoDocumento' => 'Cédula extranjera'],
            ['tipoDocumento' => 'NIT'],
            ['tipoDocumento' => 'Permiso por protección temporal'],
            ['tipoDocumento' => 'Permiso especial de permanencia'],
            ['tipoDocumento' => 'Salvoconducto para refugiados'],
        ];

        DB::table('tdocumentos')->insert($documentos);
    }
}
