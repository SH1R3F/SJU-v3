<?php

namespace App\Policies;

use App\Models\TrainingBag;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingBagPolicy
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
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-file');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TrainingBag  $trainingBag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, TrainingBag $trainingBag)
    {
        return $admin->hasPermissionTo('viewAny-file');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-file');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TrainingBag  $trainingBag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, TrainingBag $trainingBag)
    {
        return $admin->hasPermissionTo('update-file');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TrainingBag  $trainingBag
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, TrainingBag $trainingBag)
    {
        return $admin->hasPermissionTo('delete-file');
    }
}
