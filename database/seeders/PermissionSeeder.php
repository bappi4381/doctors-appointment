<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define the permissions
        $permissions = [
            'user-list-view',
            'create-user',
            'view-appointment-list',
        ];

        // Create or update permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create or update roles and assign existing permissions
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->syncPermissions(Permission::all());
    }
}
