<?php

namespace App\Policies;

use App\Models\Course\Course;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
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
        } else if ($admin->hasRole('Branch manager')) {
            // Branch managers can only update/edit the courses of their branches
            if (is_object($model)) {
                if ($model->course_branch_id != $admin->branch_id) return false;
            }
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
        return $admin->hasPermissionTo('viewAny-course');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('viewAny-course');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-course');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('update-course');
    }

    /**
     * Determine whether the user can toggle the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function toggle(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('update-course');
    }
    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Course $course)
    {
        return $admin->hasPermissionTo('delete-course');
    }
}
