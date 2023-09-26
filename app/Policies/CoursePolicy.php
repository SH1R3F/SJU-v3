<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Course\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     */
    public function before(Admin $admin, $ability, mixed $model)
    {
        if ($admin->hasRole('Site admin')) {
            return true;
        } else if ($admin->hasRole('Branch manager') || $admin->hasRole('Employee')) {
            // Branch managers can only update/edit the courses of their branches
            if (is_object($model)) {
                if ($model->course_branch_id != $admin->branch_id) return false;
            }
        }
    }

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-course') || Employee::find($admin->id)?->can('viewAny-course');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('viewAny-course') || Employee::find($admin->id)?->can('viewAny-course');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-course') || Employee::find($admin->id)?->can('create-course');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('update-course') || Employee::find($admin->id)?->can('update-course');
    }

    /**
     * Determine whether the user can toggle the model.
     */
    public function toggle(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('update-course') || Employee::find($admin->id)?->can('update-course');
    }
    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('delete-course') || Employee::find($admin->id)?->can('delete-course');
    }
}
