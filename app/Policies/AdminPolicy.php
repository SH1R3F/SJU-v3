<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {

        // Owner of webside can never be deleted or disabled
        if ($ability === 'delete' && $model->id === 1) return false;
        if ($ability === 'toggle' && $model->id === 1) return false;

        if ($admin->hasRole('Site admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-admin') || Employee::find($admin->id)?->can('viewAny-admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Admin $model)
    {
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-admin') || Employee::find($admin->id)?->can('create-admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Admin $model)
    {
        return $admin->hasPermissionTo('update-admin') || Employee::find($admin->id)?->can('update-admin');
    }

    /**
     * Determine whether the user can toggle the model.
     */
    public function toggle(Admin $admin, Admin $model)
    {
        return $admin->hasPermissionTo('update-admin') || Employee::find($admin->id)?->can('update-admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Admin $model)
    {
        return $admin->hasPermissionTo('delete-admin') || Employee::find($admin->id)?->can('delete-admin');
    }

    /**
     * Determine whether the user can notify models.
     */
    public function notify(Admin $admin)
    {
        return $admin->hasPermissionTo('notify-admin') || Employee::find($admin->id)?->can('notify-admin');
    }
}
