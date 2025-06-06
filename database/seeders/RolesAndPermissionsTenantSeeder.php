<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear o asegurarse de que el rol de administrador existe
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        $validador1Role = Role::firstOrCreate([
            'name' => 'validador1',
            'guard_name' => 'web',
        ]);

        $validador2Role = Role::firstOrCreate([
            'name' => 'validador2',
            'guard_name' => 'web',
        ]);


        // Crear o asegurarse de que los permisos existen
        $permissionsAdmin = [
            'documento' => 'Gestionar documentos del sistema',
            'genero' => 'Administrar género de usuarios',
            'nestudio' => 'Gestionar niveles de estudio',
            'tsolicitante' => 'Administrar tipos de solicitantes',
            'barrio' => 'Gestionar barrios registrados',
            'poblacion' => 'Administrar información de población',
            'ocupacion' => 'Gestionar ocupaciones disponibles',
            'roles' => 'Administrar roles del sistema',
            'permisos' => 'Gestionar permisos de usuarios',
            'user-roles' => 'Asignar roles a usuarios',
            'ciudadanos' => 'Administrar ciudadanos registrados',
            'validadores' => 'Gestionar validadores del sistema',
            'iframe' => 'Controlar el acceso a iframes externos'
        ];
        $permissionsUser = [
            'formulario' => 'Acceder y completar formularios',
            'versolicitudes' => 'Visualizar solicitudes enviadas',
        ];

        $permissionsValidador = [
            'solicitudes' => 'Gestionar solicitudes de usuarios',
            'versolicitudes' => 'Ver detalles de solicitudes',
            'historial' => 'Revisar historial de validaciones',
            'ciudadanos' => 'Ver información de ciudadanos',
        ];

        // Crear los permisos
        foreach ($permissionsAdmin as $name => $description) {
            Permission::updateOrCreate(
                ['name' => $name, 'guard_name' => 'web'],
                ['description' => $description] // Actualiza la descripción si ya existe el permiso
            );
        }

        foreach ($permissionsUser as $name => $description) {
            Permission::updateOrCreate(
                ['name' => $name, 'guard_name' => 'web'],
                ['description' => $description]
            );
        }

        foreach ($permissionsValidador as $name => $description) {
            Permission::updateOrCreate(
                ['name' => $name, 'guard_name' => 'web'],
                ['description' => $description]
            );
        }




        $adminRole->syncPermissions(Permission::whereIn('name', array_keys($permissionsAdmin))->pluck('name')->toArray());
        $userRole->syncPermissions(Permission::whereIn('name', array_keys($permissionsUser))->pluck('name')->toArray());
        $validador1Role->syncPermissions(Permission::whereIn('name', array_keys($permissionsValidador))->pluck('name')->toArray());
        $validador2Role->syncPermissions(Permission::whereIn('name', array_keys($permissionsValidador))->pluck('name')->toArray());


        // Crear el usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'jhon@nomaddi.com'],
            [
                'name' => 'Administrador',
                'nombre_2' => 'admin',
                'apellido_1' => 'admin',
                'apellido_2' => 'admin',
                'telefonoContacto' => '3105320651',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1121892936',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
            ]
        );
        // Crear el usuario user
        $user = User::firstOrCreate(
            ['email' => 'jhonrymat@gmail.com'],
            [
                'name' => 'Jhon',
                'nombre_2' => 'Henry',
                'apellido_1' => 'Matoma',
                'apellido_2' => 'Trujillo',
                'telefonoContacto' => '3105320659',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1121892935',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
            ]
        );
        // Crear el usuario user
        $validador1n1 = User::firstOrCreate(
            ['email' => 'validadoruno1.residencia@acacias.gov.co'],
            [
                'name' => 'CLARA',
                'nombre_2' => '',
                'apellido_1' => 'URREGO',
                'apellido_2' => '',
                'telefonoContacto' => '3145687888',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1111111188',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => 'C-CU-173-24',
            ]
        );

        $validador1n2 = User::firstOrCreate(
            ['email' => 'validadoruno2.residencia@acacias.gov.co'],
            [
                'name' => 'LAURA',
                'nombre_2' => 'LILIANA',
                'apellido_1' => 'RAMIRES',
                'apellido_2' => 'MARRERO',
                'telefonoContacto' => '3145687899',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1111111199',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => 'C-LR-171-24',
            ]
        );

        $validador1n3 = User::firstOrCreate(
            ['email' => 'validadoruno3.residencia@acacias.gov.co'],
            [
                'name' => 'FRANCY',
                'nombre_2' => '',
                'apellido_1' => 'HERNANDEZ',
                'apellido_2' => '',
                'telefonoContacto' => '3149687899',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1191111199',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => 'C-FH-172-24',
            ]
        );

        $validador1n4 = User::firstOrCreate(
            ['email' => 'validadoruno4.residencia@acacias.gov.co'],
            [
                'name' => 'CRIS',
                'nombre_2' => '',
                'apellido_1' => 'MORA',
                'apellido_2' => '',
                'telefonoContacto' => '3199687899',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1991111199',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => 'C-CM-174-24',
            ]
        );

        $validador2 = User::firstOrCreate(
            ['email' => 'residencia@acacias.gov.co'],
            [
                'name' => 'Mario',
                'nombre_2' => 'Aurelio',
                'apellido_1' => 'Pedroza',
                'apellido_2' => 'Sandoval',
                'telefonoContacto' => '3145687892',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '2222222222',
                'ciudadExpedicion' => 'Acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'cargo' => 'Secretario Privado',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => '003',
            ]
        );

        // Asignar el rol de administrador al usuario
        $admin->assignRole('admin');
        $user->assignRole('user');
        $validador1n1->assignRole('validador1');
        $validador1n2->assignRole('validador1');
        $validador1n3->assignRole('validador1');
        $validador1n4->assignRole('validador1');
        $validador2->assignRole('validador2');


    }
}
