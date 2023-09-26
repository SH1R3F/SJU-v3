<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Subscriber;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
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
        return $admin->hasPermissionTo('viewAny-subscriber') || Employee::find($admin->id)?->can('viewAny-subscriber');
    }

    /**
     * Determine whether the admin can export any models.
     */
    public function export(Admin $admin)
    {
        return $admin->hasPermissionTo('export-subscriber') || Employee::find($admin->id)?->can('export-subscriber');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Subscriber $subscriber)
    {
        return $admin->hasPermissionTo('view-subscriber') || Employee::find($admin->id)?->can('view-subscriber');
        //
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-subscriber') || Employee::find($admin->id)?->can('create-subscriber');
        //
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Subscriber $subscriber)
    {
        return $admin->hasPermissionTo('update-subscriber') || Employee::find($admin->id)?->can('update-subscriber');
        //
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Subscriber $subscriber)
    {
        return $admin->hasPermissionTo('delete-subscriber') || Employee::find($admin->id)?->can('delete-subscriber');
        //
    }
}
