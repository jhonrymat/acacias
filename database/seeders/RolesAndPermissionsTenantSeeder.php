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
            'documento',
            'genero',
            'nestudio',
            'tsolicitante',
            'barrio',
            'poblacion',
            'ocupacion',
            'roles',
            'permisos',
            'user-roles',
            'ciudadanos',
            'validadores'
        ];
        $permissionsUser = [
            'formulario',
            'versolicitudes',
        ];

        $permissionsValidador =[
            'solicitudes',
            'versolicitudes',
            'historial',
        ];

        // Crear los permisos
        foreach ($permissionsAdmin as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        foreach ($permissionsUser as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
        foreach ($permissionsValidador as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }




        // Asignar todos los permisos al rol de administrador
        $adminRole->syncPermissions($permissionsAdmin);
        // Asignar todos los permisos al rol de administrador
        $userRole->syncPermissions($permissionsUser);

        $validador1Role->syncPermissions($permissionsValidador);
        $validador2Role->syncPermissions($permissionsValidador);

        // Crear el usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'nombre_2' => 'admin',
                'apellido_1' => 'admin',
                'apellido_2' => 'admin',
                'telefonoContacto' => '3105320659',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1121892936',
                'ciudadExpedicion' => 'acacias',
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
            ['email' => 'usuario@gmail.com'],
            [
                'name' => 'Edwin',
                'nombre_2' => 'Fabian',
                'apellido_1' => 'Zambrano',
                'apellido_2' => 'Rincon',
                'telefonoContacto' => '3105320658',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1121892935',
                'ciudadExpedicion' => 'acacias',
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
            ['email' => 'validador1n1@gmail.com'],
            [
                'name' => 'Validador1n1',
                'nombre_2' => 'Fabian',
                'apellido_1' => 'cruz',
                'apellido_2' => 'Rincon',
                'telefonoContacto' => '3145687888',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1111111188',
                'ciudadExpedicion' => 'acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => '001',
            ]
        );

        $validador1n2 = User::firstOrCreate(
            ['email' => 'validador1n2@gmail.com'],
            [
                'name' => 'Validador1n2',
                'nombre_2' => 'santiago',
                'apellido_1' => 'rivera',
                'apellido_2' => 'zapata',
                'telefonoContacto' => '3145687899',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '1111111199',
                'ciudadExpedicion' => 'acacias',
                'fechaNacimiento' => '1980-01-12 00:00:00',
                'id_nivelEstudio' => 1,
                'id_genero' => 1,
                'id_ocupacion' => 1,
                'id_poblacion' => 1,
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
                'codigo' => '002',
            ]
        );

        $validador2 = User::firstOrCreate(
            ['email' => 'validador2@gmail.com'],
            [
                'name' => 'Validador2',
                'nombre_2' => 'Fabian',
                'apellido_1' => 'cruz',
                'apellido_2' => 'Rincon',
                'telefonoContacto' => '3145687892',
                'id_tipoSolicitante' => 1,
                'id_tipoDocumento' => 1,
                'numeroIdentificacion' => '2222222222',
                'ciudadExpedicion' => 'acacias',
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
        $validador2->assignRole('validador2');


    }
}
