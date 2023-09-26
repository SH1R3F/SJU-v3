<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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
        return $admin->hasPermissionTo('viewAny-category') || Employee::find($admin->id)?->can('viewAny-category');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Category $category)
    {
        return $admin->hasPermissionTo('view-category') || Employee::find($admin->id)?->can('view-category');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-category') || Employee::find($admin->id)?->can('create-category');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Category $category)
    {
        return $admin->hasPermissionTo('update-category') || Employee::find($admin->id)?->can('update-category');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Category $category)
    {
        return $admin->hasPermissionTo('delete-category') || Employee::find($admin->id)?->can('delete-category');
    }
}
