<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'Create Users']);
        Permission::create(['name' => 'Edit Users']);
        Permission::create(['name' => 'Delete Users']);
        Permission::create(['name' => 'Create Roles']);
        Permission::create(['name' => 'Edit Roles']);
        Permission::create(['name' => 'Delete Roles']);
        Permission::create(['name' => 'Create Permissions']);
        Permission::create(['name' => 'Edit Permissions']);
        Permission::create(['name' => 'Delete Permissions']);
        Permission::create(['name' => 'Create Trips']);
        Permission::create(['name' => 'Edit Trips']);
        Permission::create(['name' => 'Delete Trips']);
        Permission::create(['name' => 'Create Places']);
        Permission::create(['name' => 'Edit Places']);
        Permission::create(['name' => 'Delete Places']);
        Permission::create(['name' => 'Create Fares']);
        Permission::create(['name' => 'Edit Fares']);
        Permission::create(['name' => 'Delete Fares']);
        Permission::create(['name' => 'Create Jeeps']);
        Permission::create(['name' => 'Edit Jeeps']);
        Permission::create(['name' => 'Delete Jeeps']);
        Permission::create(['name' => 'Create Cards']);
        Permission::create(['name' => 'Edit Cards']);
        Permission::create(['name' => 'Delete Cards']);
    }
}
