<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed roles
        $admin   = Role::create(['name' => 'Site admin', 'guard_name' => 'admin']);
        $manager = Role::create(['name' => 'Branch manager', 'guard_name' => 'admin']);
        $editor  = Role::create(['name' => 'News editor', 'guard_name' => 'admin']);

        /**
         * Permissions Seeding
         */
        // Roles permissions
        Permission::create(['name' => 'viewAny-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'create-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-role', 'guard_name' => 'admin']);
    }
}
