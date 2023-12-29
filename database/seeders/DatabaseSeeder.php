<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $ponenteRole = Role::create(['name' => 'ponente']); // Nuevo rol 'ponente'

        // Crear permisos
        $manageUsersPermission = Permission::create(['name' => 'manage users']);
        $managePostsPermission = Permission::create(['name' => 'manage posts']);

        // Asignar permisos a los roles
        $adminRole->givePermissionTo($manageUsersPermission);
        $adminRole->givePermissionTo($managePostsPermission);

        $userRole->givePermissionTo($managePostsPermission);
        $ponenteRole->givePermissionTo($managePostsPermission);
    }
}
