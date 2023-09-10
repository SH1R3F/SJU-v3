<?php

namespace App\Policies;

use App\Models\MembershipTransfer;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class MembershipTransferPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\Admin  $admin
     * @param  string  $ability
     * @param  mixed  $model
     * @return void|bool
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin') && $ability != 'pay') {
            return true;
        } else if ($admin->hasRole('Branch manager')) {
            if ($ability === 'delete' && $model->transfer_to != $admin->branch_id) return false;
            if ($ability === 'update' && $model->transfer_from != $admin->branch_id) return false;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-transfer');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\MembershipTransfer  $membershipTransfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, MembershipTransfer $membershipTransfer)
    {
        return $admin->hasPermissionTo('viewAny-transfer');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-transfer');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\MembershipTransfer  $membershipTransfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, MembershipTransfer $membershipTransfer)
    {
        return $admin->hasPermissionTo('update-transfer');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\MembershipTransfer  $membershipTransfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, MembershipTransfer $membershipTransfer)
    {
        return $admin->hasPermissionTo('delete-transfer');
    }
}
