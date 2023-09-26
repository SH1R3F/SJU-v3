<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\TrainingBag;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingBagPolicy
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
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-file') || Employee::find($admin->id)?->can('viewAny-file');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, TrainingBag $trainingBag)
    {
        return $admin->hasPermissionTo('viewAny-file') || Employee::find($admin->id)?->can('viewAny-file');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-file') || Employee::find($admin->id)?->can('create-file');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, TrainingBag $trainingBag)
    {
        return $admin->hasPermissionTo('update-file') || Employee::find($admin->id)?->can('update-file');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, TrainingBag $trainingBag)
    {
        return $admin->hasPermissionTo('delete-file') || Employee::find($admin->id)?->can('delete-file');
    }
}
