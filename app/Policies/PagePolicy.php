<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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
        return $admin->hasPermissionTo('viewAny-page') || Employee::find($admin->id)?->can('viewAny-page');
    }

    /**
     * Determine whether the admin can view the model.

     */
    public function view(Admin $admin, Page $page)
    {
        return $admin->hasPermissionTo('view-page') || Employee::find($admin->id)?->can('view-page');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-page') || Employee::find($admin->id)?->can('create-page');
    }

    /**
     * Determine whether the admin can update the model.

     */
    public function update(Admin $admin, Page $page)
    {
        return $admin->hasPermissionTo('update-page') || Employee::find($admin->id)?->can('update-page');
    }

    /**
     * Determine whether the admin can delete the model.

     */
    public function delete(Admin $admin, Page $page)
    {
        return $admin->hasPermissionTo('delete-page') || Employee::find($admin->id)?->can('delete-page');
    }
}
