<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Certificado de Residencia',
            'logo_path' => '/images/logo-web.png', // Ruta por defecto
            'favicon_path' => '/images/favicon.ico', // Ruta por defecto
        ]);
    }
}
