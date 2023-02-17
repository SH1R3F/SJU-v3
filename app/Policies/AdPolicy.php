<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy
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
        } else if ($admin->hasRole('News editor')) {
            // Show data depending on a condition?
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
        return $admin->hasPermissionTo('viewAny-ad');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-ad');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Ad $ad)
    {
        return $admin->hasPermissionTo('update-ad');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Ad $ad)
    {
        return $admin->hasPermissionTo('delete-ad');
    }
}
