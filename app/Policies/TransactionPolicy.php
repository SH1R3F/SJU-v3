<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        } else if ($admin->hasRole('Branch manager') || $admin->hasRole('Employee')) {
            // Branch managers can only update/edit the members of their branches
            if (is_object($model)) {
                if ($model->member->branch_id != $admin->branch_id) return false;
            }
        }
    }

    /**
     * Determine whether the admin can view index accepted members.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('manage-transaction') || Employee::find($admin->id)?->can('manage-transaction');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Transaction $transaction)
    {
        return $admin->hasPermissionTo('manage-transaction') || Employee::find($admin->id)?->can('manage-transaction');
    }
}
