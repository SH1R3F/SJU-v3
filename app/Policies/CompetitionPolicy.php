<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Competition;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitionPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin') && $ability != 'pay') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-competition') || Employee::find($admin->id)?->can('viewAny-competition');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Competition $competition)
    {
        return $admin->hasPermissionTo('viewAny-competition') || Employee::find($admin->id)?->can('viewAny-competition');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-competition') || Employee::find($admin->id)?->can('create-competition');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Competition $competition)
    {
        return $admin->hasPermissionTo('update-competition') || Employee::find($admin->id)?->can('update-competition');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Competition $competition)
    {
        return $admin->hasPermissionTo('delete-competition') || Employee::find($admin->id)?->can('delete-competition');
    }

}
