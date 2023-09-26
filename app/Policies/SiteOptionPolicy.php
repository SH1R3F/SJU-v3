<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\SiteOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteOptionPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        }
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function manage(Admin $admin)
    {
        return $admin->hasPermissionTo('manage-site-options') || Employee::find($admin->id)?->can('manage-site-options');
    }
}
