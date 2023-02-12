<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
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
            // Branch managers can only update/edit the members of their branches
            if (is_object($model)) {
                if ($model->branch_id != $admin->branch_id) return false;
            }
        }
    }

    /**
     * Determine whether the admin can view index accepted members.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-member');
    }

    /**
     * Determine whether the admin can view branch approval members.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewBranch(Admin $admin)
    {
        return $admin->hasPermissionTo('branch-member');
    }

    /**
     * Determine whether the admin can view branch approved waiting admin acceptance members.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAcceptance(Admin $admin)
    {
        return $admin->hasPermissionTo('acceptance-member');
    }

    /**
     * Determine whether the admin can view refused members.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewRefused(Admin $admin)
    {
        return $admin->hasPermissionTo('refused-member');
    }

    /**
     * Determine whether the admin can export models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function export(Admin $admin)
    {
        return $admin->hasPermissionTo('export-member');
    }

    /**
     * Determine whether the admin can notify models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function notify(Admin $admin)
    {
        return $admin->hasPermissionTo('notify-member');
    }

    /**
     * Determine whether the admin can view the member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('view-member');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-member');
    }

    /**
     * Determine whether the admin can update the member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('update-member');
    }

    /**
     * Determine whether the admin can set member as paid.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function pay(Admin $admin, Member $member)
    {
        if (!$member->canPay()) return false;
        return $admin->hasPermissionTo('pay-member');
    }

    /**
     * Determine whether the admin can Enable/Disable member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function toggle(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('toggle-member');
    }

    /**
     * Determine whether the admin can Accept member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function accept(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('accept-member');
    }

    /**
     * Determine whether the admin can Approve member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function approve(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('approve-member');
    }

    /**
     * Determine whether the admin can Dispprove member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function disapprove(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('disapprove-member');
    }

    /**
     * Determine whether the admin can Refuse member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function refuse(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('refuse-member');
    }

    /**
     * Determine whether the admin can delete the member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('delete-member');
    }

    /**
     * Determine whether the admin can restore the member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Member $member)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the member.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Member $member)
    {
        //
    }
}
