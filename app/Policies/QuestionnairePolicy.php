<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\Course\Questionnaire;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionnairePolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
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
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('viewAny-questionnaire') || Employee::find($admin->id)?->can('viewAny-questionnaire');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Questionnaire $questionnaire)
    {
        return $admin->hasPermissionTo('view-questionnaire') || Employee::find($admin->id)?->can('view-questionnaire');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-questionnaire') || Employee::find($admin->id)?->can('create-questionnaire');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Questionnaire $questionnaire)
    {
        return $admin->hasPermissionTo('update-questionnaire') || Employee::find($admin->id)?->can('update-questionnaire');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Questionnaire $questionnaire)
    {
        return $admin->hasPermissionTo('delete-questionnaire') || Employee::find($admin->id)?->can('delete-questionnaire');
    }
}
