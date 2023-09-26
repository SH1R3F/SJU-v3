<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\MembershipTransfer;
use Illuminate\Auth\Access\HandlesAuthorization;

class MembershipTransferPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin') && $ability != 'pay') {
            return true;
        } else if ($admin->hasRole('Branch manager') || $admin->hasRole('Employee')) {
            if ($ability === 'delete' && $model->transfer_to != $admin->branch_id) return false;
            if ($ability === 'update' && $model->transfer_from != $admin->branch_id) return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-transfer') || Employee::find($admin->id)?->can('viewAny-transfer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, MembershipTransfer $membershipTransfer)
    {
        return $admin->hasPermissionTo('viewAny-transfer') || Employee::find($admin->id)?->can('viewAny-transfer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-transfer') || Employee::find($admin->id)?->can('create-transfer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, MembershipTransfer $membershipTransfer)
    {
        return $admin->hasPermissionTo('update-transfer') || Employee::find($admin->id)?->can('update-transfer');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, MembershipTransfer $membershipTransfer)
    {
        return $admin->hasPermissionTo('delete-transfer') || Employee::find($admin->id)?->can('delete-transfer');
    }
}
