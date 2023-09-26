<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-invitation') || Employee::find($admin->id)?->can('viewAny-invitation');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Invitation $invitation)
    {
        return $admin->hasPermissionTo('view-invitation') || Employee::find($admin->id)?->can('view-invitation');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-invitation') || Employee::find($admin->id)?->can('create-invitation');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Invitation $invitation)
    {
        return $admin->hasPermissionTo('update-invitation') || Employee::find($admin->id)?->can('update-invitation');
    }

    /**
     * Determine whether the user can toggle the model.
     */
    public function toggle(Admin $admin, Invitation $invitation)
    {
        return $admin->hasPermissionTo('update-invitation') || Employee::find($admin->id)?->can('update-invitation');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Invitation $invitation)
    {
        return $admin->hasPermissionTo('delete-invitation') || Employee::find($admin->id)?->can('delete-invitation');
    }
}
