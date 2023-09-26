<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Course\Template;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemplatePolicy
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
        return $admin->hasPermissionTo('viewAny-template') || Employee::find($admin->id)?->can('viewAny-template');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Template $template)
    {
        return $admin->hasPermissionTo('viewAny-template') || Employee::find($admin->id)?->can('viewAny-template');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-template') || Employee::find($admin->id)?->can('create-template');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Template $template)
    {
        return $admin->hasPermissionTo('update-template') || Employee::find($admin->id)?->can('update-template');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Template $template)
    {
        return $admin->hasPermissionTo('delete-template') || Employee::find($admin->id)?->can('delete-template');
    }
}
