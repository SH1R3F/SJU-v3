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
        if ($admin->hasRole('Site admin')) {
            return true;
        }
    }
    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-member');
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
     * Determine whether the admin can toggle the member.
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
