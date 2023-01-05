<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

        // Owner of webside can never be deleted or disabled
        if ($ability === 'delete' && $model->id === 1) return false;
        if ($ability === 'toggle' && $model->id === 1) return false;

        if ($admin->hasRole('Site admin')) {
            return true;
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
        return $admin->hasPermissionTo('viewAny-admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Admin $model)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Admin $model)
    {
        return $admin->hasPermissionTo('update-admin');
    }

    /**
     * Determine whether the user can toggle the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function toggle(Admin $admin, Admin $model)
    {
        return $admin->hasPermissionTo('update-admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Admin $model)
    {
        return $admin->hasPermissionTo('delete-admin');
    }

    /**
     * Determine whether the user can notify models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function notify(Admin $admin)
    {
        return $admin->hasPermissionTo('notify-admin');
    }
}
