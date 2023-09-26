<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Media;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
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
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-media') || Employee::find($admin->id)?->can('viewAny-media');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Media $media)
    {
        return $admin->hasPermissionTo('viewAny-media') || Employee::find($admin->id)?->can('viewAny-media');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-media') || Employee::find($admin->id)?->can('create-media');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Media $media)
    {
        return $admin->hasPermissionTo('viewAny-media') || Employee::find($admin->id)?->can('viewAny-media');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Media $media)
    {
        return $admin->hasPermissionTo('delete-media') || Employee::find($admin->id)?->can('delete-media');
    }
}
