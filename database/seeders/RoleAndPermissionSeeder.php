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
        $admin   = Role::updateOrCreate(['name' => 'Site admin'], ['name' => 'Site admin', 'guard_name' => 'admin']);
        $manager = Role::updateOrCreate(['name' => 'Branch manager'], ['name' => 'Branch manager', 'guard_name' => 'admin']);
        $editor  = Role::updateOrCreate(['name' => 'News editor'], ['name' => 'News editor', 'guard_name' => 'admin']);

        /**
         * Permissions Seeding
         */
        // Roles permissions
        Permission::updateOrCreate(['name' => 'viewAny-role'], ['name' => 'viewAny-role', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-role'], ['name' => 'create-role', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-role'], ['name' => 'update-role', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-role'], ['name' => 'delete-role', 'guard_name' => 'admin']);
        // Admins permissions
        Permission::updateOrCreate(['name' => 'viewAny-admin'], ['name' => 'viewAny-admin', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-admin'], ['name' => 'create-admin', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-admin'], ['name' => 'update-admin', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-admin'], ['name' => 'delete-admin', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'notify-admin'], ['name' => 'notify-admin', 'guard_name' => 'admin']);
        // Members permissions
        Permission::updateOrCreate(['name' => 'viewAny-member'], ['name' => 'viewAny-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-member'], ['name' => 'view-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-member'], ['name' => 'create-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-member'], ['name' => 'update-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-member'], ['name' => 'delete-member', 'guard_name' => 'admin']);
        // Permission::updateOrCreate(['name' => 'notify-member'], ['name' => 'notify-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'toggle-member'], ['name' => 'toggle-member', 'guard_name' => 'admin']); // Edit status (approve / disapprove, Accept, Lock, etc)

        $admin->syncPermissions(Permission::pluck('name'));
    }
}
