<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        $admin    = Role::updateOrCreate(['name' => 'Site admin'], ['name' => 'Site admin', 'guard_name' => 'admin']);
        $manager  = Role::updateOrCreate(['name' => 'Branch manager'], ['name' => 'Branch manager', 'guard_name' => 'admin']);
        $editor   = Role::updateOrCreate(['name' => 'News editor'], ['name' => 'News editor', 'guard_name' => 'admin']);
        $employee = Role::updateOrCreate(['name' => 'Employee'], ['name' => 'Employee', 'guard_name' => 'admin']);

        /**
         * Permissions Seeding
         */
        // Site options
        Permission::updateOrCreate(['name' => 'manage-site-options'], ['name' => 'manage-site-options', 'guard_name' => 'admin']);
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
        Permission::updateOrCreate(['name' => 'pay-member'], ['name' => 'pay-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'accept-member'], ['name' => 'accept-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'approve-member'], ['name' => 'approve-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'disapprove-member'], ['name' => 'disapprove-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'refuse-member'], ['name' => 'refuse-member', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'manage-invoice'], ['name' => 'manage-invoice', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'manage-transaction'], ['name' => 'manage-transaction', 'guard_name' => 'admin']);

        /**
         * Subscribers management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-subscriber'], ['name' => 'viewAny-subscriber', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'export-subscriber'], ['name' => 'export-subscriber', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-subscriber'], ['name' => 'view-subscriber', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-subscriber'], ['name' => 'create-subscriber', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-subscriber'], ['name' => 'update-subscriber', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-subscriber'], ['name' => 'delete-subscriber', 'guard_name' => 'admin']);

        /**
         * Volunteers management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-volunteer'], ['name' => 'viewAny-volunteer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'export-volunteer'], ['name' => 'export-volunteer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-volunteer'], ['name' => 'view-volunteer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-volunteer'], ['name' => 'create-volunteer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-volunteer'], ['name' => 'update-volunteer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-volunteer'], ['name' => 'delete-volunteer', 'guard_name' => 'admin']);

        /**
         * Technical support management permissions
         */
        Permission::updateOrCreate(['name' => 'members-ticket'], ['name' => 'members-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'subscribers-ticket'], ['name' => 'subscribers-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'volunteers-ticket'], ['name' => 'volunteers-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'managers-ticket'], ['name' => 'managers-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-ticket'], ['name' => 'view-ticket', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-ticket'], ['name' => 'delete-ticket', 'guard_name' => 'admin']);

        /**
         * Course management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-course'], ['name' => 'viewAny-course', 'guard_name' => 'admin']);
        // Permission::updateOrCreate(['name' => 'view-course'], ['name' => 'view-course', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-course'], ['name' => 'create-course', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-course'], ['name' => 'update-course', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-course'], ['name' => 'delete-course', 'guard_name' => 'admin']);

        /**
         * Template management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-template'], ['name' => 'viewAny-template', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-template'], ['name' => 'create-template', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-template'], ['name' => 'update-template', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-template'], ['name' => 'delete-template', 'guard_name' => 'admin']);

        /**
         * Questionnaire management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-questionnaire'], ['name' => 'viewAny-questionnaire', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-questionnaire'], ['name' => 'view-questionnaire', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-questionnaire'], ['name' => 'create-questionnaire', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-questionnaire'], ['name' => 'update-questionnaire', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-questionnaire'], ['name' => 'delete-questionnaire', 'guard_name' => 'admin']);

        /**
         * Category management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-category'], ['name' => 'viewAny-category', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-category'], ['name' => 'view-category', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-category'], ['name' => 'create-category', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-category'], ['name' => 'update-category', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-category'], ['name' => 'delete-category', 'guard_name' => 'admin']);

        /**
         * Page management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-page'], ['name' => 'viewAny-page', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-page'], ['name' => 'view-page', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-page'], ['name' => 'create-page', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-page'], ['name' => 'update-page', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-page'], ['name' => 'delete-page', 'guard_name' => 'admin']);

        /**
         * Article management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-article'], ['name' => 'viewAny-article', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-article'], ['name' => 'view-article', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-article'], ['name' => 'create-article', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-article'], ['name' => 'update-article', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-article'], ['name' => 'delete-article', 'guard_name' => 'admin']);

        /**
         * Ads management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-ad'], ['name' => 'viewAny-ad', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-ad'], ['name' => 'create-ad', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-ad'], ['name' => 'update-ad', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-ad'], ['name' => 'delete-ad', 'guard_name' => 'admin']);

        /**
         * Urls management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-url'], ['name' => 'viewAny-url', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-url'], ['name' => 'create-url', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-url'], ['name' => 'update-url', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-url'], ['name' => 'delete-url', 'guard_name' => 'admin']);

        /**
         * Studio management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-media'], ['name' => 'viewAny-media', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-media'], ['name' => 'create-media', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-media'], ['name' => 'delete-media', 'guard_name' => 'admin']);

        /**
         * Invitations management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-invitation'], ['name' => 'viewAny-invitation', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'view-invitation'], ['name' => 'view-invitation', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-invitation'], ['name' => 'create-invitation', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-invitation'], ['name' => 'update-invitation', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-invitation'], ['name' => 'delete-invitation', 'guard_name' => 'admin']);

        /**
         * Training bag management permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-file'], ['name' => 'viewAny-file', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-file'], ['name' => 'create-file', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-file'], ['name' => 'update-file', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-file'], ['name' => 'delete-file', 'guard_name' => 'admin']);

        /**
         * Membship transfer permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-transfer'], ['name' => 'viewAny-transfer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-transfer'], ['name' => 'create-transfer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-transfer'], ['name' => 'update-transfer', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-transfer'], ['name' => 'delete-transfer', 'guard_name' => 'admin']);

        /**
         * Compeitions permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-competition'], ['name' => 'viewAny-competition', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-competition'], ['name' => 'create-competition', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-competition'], ['name' => 'update-competition', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-competition'], ['name' => 'delete-competition', 'guard_name' => 'admin']);

        /**
         * Employees permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-employee'], ['name' => 'viewAny-employee', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-employee'], ['name' => 'create-employee', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'update-employee'], ['name' => 'update-employee', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-employee'], ['name' => 'delete-employee', 'guard_name' => 'admin']);

        /**
         * Elections permissions
         */
        Permission::updateOrCreate(['name' => 'viewAny-candidate'], ['name' => 'viewAny-candidate', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'create-candidate'], ['name' => 'create-candidate', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'delete-candidate'], ['name' => 'delete-candidate', 'guard_name' => 'admin']);

        $admin->syncPermissions(Permission::pluck('name'));
    }
}
