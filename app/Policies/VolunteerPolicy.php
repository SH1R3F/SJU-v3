<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Volunteer;
use Illuminate\Auth\Access\HandlesAuthorization;

class VolunteerPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        } else if ($admin->hasRole('Branch manager') || $admin->hasRole('Employee')) {
            // Branch managers can only update/edit the volunteers of their branches
            if (is_object($model)) {
                if ($model->branch_id != $admin->branch_id) return false;
            }
        }
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-volunteer') || Employee::find($admin->id)?->can('viewAny-volunteer');
    }

    /**
     * Determine whether the admin can export any models.
     */
    public function export(Admin $admin)
    {
        return $admin->hasPermissionTo('export-volunteer') || Employee::find($admin->id)?->can('export-volunteer');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Volunteer $volunteer)
    {
        return $admin->hasPermissionTo('view-volunteer') || Employee::find($admin->id)?->can('view-volunteer');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-volunteer') || Employee::find($admin->id)?->can('create-volunteer');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Volunteer $volunteer)
    {
        return $admin->hasPermissionTo('update-volunteer') || Employee::find($admin->id)?->can('update-volunteer');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Volunteer $volunteer)
    {
        return $admin->hasPermissionTo('delete-volunteer') || Employee::find($admin->id)?->can('delete-volunteer');
    }
}
