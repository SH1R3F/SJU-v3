<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $role)
    {
        // Basic roles should never be edited or deleted
        if ($ability === 'delete' && in_array($role->name, ['Site admin', 'Branch manager', 'News editor', 'Employee'])) return false;

        if ($admin->hasRole('Site admin')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-role') || Employee::find($admin->id)?->can('viewAny-role');;
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-role') || Employee::find($admin->id)?->can('create-role');;
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Role $role)
    {
        return $admin->hasPermissionTo('update-role') || Employee::find($admin->id)?->can('update-role');;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Role $role)
    {
        return $admin->hasPermissionTo('delete-role') || Employee::find($admin->id)?->can('delete-role');;
    }
}
