<?php

namespace App\Policies;

use App\Models\Candidate;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatePolicy
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
    public function export(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-candidate') || Employee::find($admin->id)?->can('viewAny-candidate');
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-candidate') || Employee::find($admin->id)?->can('viewAny-candidate');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Candidate $candidate)
    {
        return $admin->hasPermissionTo('viewAny-candidate') || Employee::find($admin->id)?->can('viewAny-candidate');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-candidate') || Employee::find($admin->id)?->can('create-candidate');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Candidate $candidate)
    {
        return $admin->hasPermissionTo('delete-candidate') || Employee::find($admin->id)?->can('delete-candidate');
    }
}
