<?php

namespace App\Policies;

use App\Models\Subscriber;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
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
        return $admin->hasPermissionTo('viewAny-subscriber');
    }

    /**
     * Determine whether the admin can export any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function export(Admin $admin)
    {
        return $admin->hasPermissionTo('export-subscriber');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Subscriber $subscriber)
    {
        return $admin->hasPermissionTo('view-subscriber');
        //
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-subscriber');
        //
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Subscriber $subscriber)
    {
        return $admin->hasPermissionTo('update-subscriber');
        //
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Subscriber $subscriber)
    {
        return $admin->hasPermissionTo('delete-subscriber');
        //
    }
}
