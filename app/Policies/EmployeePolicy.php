<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $employee)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        }

        if (($admin->hasRole('Branch manager') || $admin->hasRole('Employee')) && is_object($employee) && $employee->branch_id !== $admin->branch_id){
            return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-employee') || Employee::find($admin->id)?->can('viewAny-employee');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Employee $employee)
    {
        return $admin->hasPermissionTo('viewAny-employee') || Employee::find($admin->id)?->can('viewAny-employee');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-employee') || Employee::find($admin->id)?->can('create-employee');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Employee $employee)
    {
        return $admin->hasPermissionTo('update-employee') || Employee::find($admin->id)?->can('update-employee');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Employee $employee)
    {
        return $admin->hasPermissionTo('delete-employee') || Employee::find($admin->id)?->can('delete-employee');
    }
}
