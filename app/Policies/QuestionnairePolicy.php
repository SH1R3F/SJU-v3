<?php

namespace App\Policies;

use App\Models\Course\Questionnaire;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionnairePolicy
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
        // Default questionnaire cannot be deleted.
        if ($ability == 'delete' && $model->id == 24) return false;

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
        return $admin->hasPermissionTo('viewAny-questionnaire');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Questionnaire $questionnaire)
    {
        return $admin->hasPermissionTo('view-questionnaire');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-questionnaire');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Questionnaire $questionnaire)
    {
        return $admin->hasPermissionTo('update-questionnaire');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Questionnaire $questionnaire)
    {
        return $admin->hasPermissionTo('delete-questionnaire');
    }
}
