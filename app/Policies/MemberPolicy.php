<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
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
            // Branch managers can only update/edit the members of their branches
            if (is_object($model)) {
                if ($model->branch_id != $admin->branch_id) return false;
            }
        }

    }

    /**
     * Determine whether the admin can view index accepted members.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-member') || Employee::find($admin->id)?->can('viewAny-member');
    }

    /**
     * Determine whether the admin can view branch approval members.
     */
    public function viewBranch(Admin $admin)
    {
        return $admin->hasPermissionTo('branch-member') || Employee::find($admin->id)?->can('branch-member');
    }

    /**
     * Determine whether the admin can view branch approved waiting admin acceptance members.
     */
    public function viewAcceptance(Admin $admin)
    {
        return $admin->hasPermissionTo('acceptance-member') || Employee::find($admin->id)?->can('acceptance-member');
    }

    /**
     * Determine whether the admin can view refused members.
     */
    public function viewRefused(Admin $admin)
    {
        return $admin->hasPermissionTo('refused-member') || Employee::find($admin->id)?->can('refused-member');
    }

    /**
     * Determine whether the admin can export models.
     */
    public function export(Admin $admin)
    {
        return $admin->hasPermissionTo('export-member') || Employee::find($admin->id)?->can('export-member');
    }

    /**
     * Determine whether the admin can notify models.
     */
    public function notify(Admin $admin)
    {
        return $admin->hasPermissionTo('notify-member') || Employee::find($admin->id)?->can('notify-member');
    }

    /**
     * Determine whether the admin can view the member.
     */
    public function view(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('view-member') || Employee::find($admin->id)?->can('view-member');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-member') || Employee::find($admin->id)?->can('create-member');
    }

    /**
     * Determine whether the admin can update the member.
     */
    public function update(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('update-member') || Employee::find($admin->id)?->can('update-member');
    }

    /**
     * Determine whether the admin can set member as paid.
     */
    public function pay(Admin $admin, Member $member)
    {
        if (!$member->canPay()) return false;
        return $admin->hasPermissionTo('pay-member') || Employee::find($admin->id)?->can('pay-member');
    }

    /**
     * Determine whether the admin can Enable/Disable member.
     */
    public function toggle(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('toggle-member') || Employee::find($admin->id)?->can('toggle-member');
    }

    /**
     * Determine whether the admin can Accept member.
     */
    public function accept(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('accept-member') || Employee::find($admin->id)?->can('accept-member');
    }

    /**
     * Determine whether the admin can Approve member.
     */
    public function approve(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('approve-member') || Employee::find($admin->id)?->can('approve-member');
    }

    /**
     * Determine whether the admin can Dispprove member.
     */
    public function disapprove(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('disapprove-member') || Employee::find($admin->id)?->can('disapprove-member');
    }

    /**
     * Determine whether the admin can Refuse member.
     */
    public function refuse(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('refuse-member') || Employee::find($admin->id)?->can('refuse-member');
    }

    /**
     * Determine whether the admin can delete the member.
     */
    public function delete(Admin $admin, Member $member)
    {
        return $admin->hasPermissionTo('delete-member') || Employee::find($admin->id)?->can('delete-member');
    }
}
