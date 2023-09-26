<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        } else if ($admin->hasRole('News editor')) {
            // Show data depending on a condition?
        }
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-ad') || Employee::find($admin->id)?->can('viewAny-ad');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-ad') || Employee::find($admin->id)?->can('create-ad');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Ad $ad)
    {
        return $admin->hasPermissionTo('update-ad') || Employee::find($admin->id)?->can('update-ad');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Ad $ad)
    {
        return $admin->hasPermissionTo('delete-ad') || Employee::find($admin->id)?->can('delete-ad');
    }
}
