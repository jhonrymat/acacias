<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TdocumentosSeeder extends Seeder
{
    public function run()
    {
        $documentos = [
            ['tipoDocumento' => 'Registro Civil'],
            ['tipoDocumento' => 'Tarjeta de identidad'],
            ['tipoDocumento' => 'Cédula de ciudadanía'],
            ['tipoDocumento' => 'Cédula extranjera'],
            ['tipoDocumento' => 'NIT'],
            ['tipoDocumento' => 'Permiso Por Protección Temporal'],
            ['tipoDocumento' => 'Permiso Especial de Permanencia'],
            ['tipoDocumento' => 'Salvoconducto para refugiados'],
        ];

        DB::table('tdocumentos')->insert($documentos);
    }
}
