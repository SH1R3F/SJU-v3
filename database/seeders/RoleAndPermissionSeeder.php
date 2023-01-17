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

        /**
         * Member management permissions
         */
        // View accepted users page
        Permission::updateOrCreate(['name' => 'viewAny-member'], ['name' => 'viewAny-member', 'guard_name' => 'admin']);
        // View branch approval members [unapproved] page
        Permission::updateOrCreate(['name' => 'branch-member'], ['name' => 'branch-member', 'guard_name' => 'admin']);
        // View admin acceptance members [approved]
        Permission::updateOrCreate(['name' => 'acceptance-member'], ['name' => 'acceptance-member', 'guard_name' => 'admin']);
        // View refused members [refused]
        Permission::updateOrCreate(['name' => 'refused-member'], ['name' => 'refused-member', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name' => 'export-member'], ['name' => 'export-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-member'], ['name' => 'view-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-member'], ['name' => 'create-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-member'], ['name' => 'update-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-member'], ['name' => 'delete-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'notify-member'], ['name' => 'notify-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'toggle-member'], ['name' => 'toggle-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'accept-member'], ['name' => 'accept-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'approve-member'], ['name' => 'approve-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'disapprove-member'], ['name' => 'disapprove-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'refuse-member'], ['name' => 'refuse-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'manage-invoice'], ['name' => 'manage-invoice', 'guard_name' => 'admin']);

        Permission::updateOrCreate(['name' => 'members-ticket'], ['name' => 'members-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'subscribers-ticket'], ['name' => 'subscribers-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'volunteers-ticket'], ['name' => 'volunteers-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-ticket'], ['name' => 'view-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-ticket'], ['name' => 'delete-ticket', 'guard_name' => 'admin']);

        $admin->syncPermissions(Permission::pluck('name'));
    }
}
