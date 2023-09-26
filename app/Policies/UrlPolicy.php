<?php

namespace App\Policies;

use App\Models\Url;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class UrlPolicy
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
        return $admin->hasPermissionTo('viewAny-url') || Employee::find($admin->id)?->can('viewAny-url');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-url') || Employee::find($admin->id)?->can('create-url');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Url $url)
    {
        return $admin->hasPermissionTo('update-url') || Employee::find($admin->id)?->can('update-url');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Url $url)
    {
        return $admin->hasPermissionTo('delete-url') || Employee::find($admin->id)?->can('delete-url');
    }
}
