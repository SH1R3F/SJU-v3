<?php

namespace App\Policies;

use App\Models\SiteOption;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteOptionPolicy
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
    public function manage(Admin $admin)
    {
        return $admin->hasPermissionTo('manage-site-options');
    }
}
