<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsTenantSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GenerosSeeder::class);
        $this->call(NestudioSeeder::class);
        $this->call(OcupacionSeeder::class);
        $this->call(PoblacionSeeder::class);
        $this->call(TdocumentosSeeder::class);
        $this->call(TsolicitanteSeeder::class);
        $this->call(BarrioSeeder::class);

        $this->call(RolesAndPermissionsTenantSeeder::class);


    }
}
