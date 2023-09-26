<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
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
        return $admin->hasPermissionTo('viewAny-article') || Employee::find($admin->id)?->can('viewAny-article');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, Article $article)
    {
        return $admin->hasPermissionTo('view-article') || Employee::find($admin->id)?->can('view-article');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('create-article') || Employee::find($admin->id)?->can('create-article');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, Article $article)
    {
        return $admin->hasPermissionTo('update-article') || Employee::find($admin->id)?->can('update-article');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, Article $article)
    {
        return $admin->hasPermissionTo('delete-article') || Employee::find($admin->id)?->can('delete-article');
    }
}
