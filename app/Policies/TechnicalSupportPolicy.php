<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Employee;
use App\Models\TechnicalSupportTicket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TechnicalSupportPolicy
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
     * Determine whether the admin can view any tickets of members.
     */
    public function viewMembers(Admin $admin)
    {
        return $admin->hasPermissionTo('members-ticket') || Employee::find($admin->id)?->can('members-ticket');
    }

    /**
     * Determine whether the admin can view any tickets of subscribers.
     */
    public function viewSubscribers(Admin $admin)
    {
        return $admin->hasPermissionTo('subscribers-ticket') || Employee::find($admin->id)?->can('subscribers-ticket');
    }

    /**
     * Determine whether the admin can view any tickets of volunteers.
     */
    public function viewVolunteers(Admin $admin)
    {
        return $admin->hasPermissionTo('volunteers-ticket') || Employee::find($admin->id)?->can('volunteers-ticket');
    }
    /**
     * Determine whether the admin can view any tickets of branch managers.
     */
    public function viewManagers(Admin $admin)
    {
        return $admin->hasPermissionTo('managers-ticket') || Employee::find($admin->id)?->can('managers-ticket');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, TechnicalSupportTicket $technicalSupportTicket)
    {
        if (!$admin->hasPermissionTo('view-ticket')) return false;

        if ($technicalSupportTicket->supportable instanceof Member) return $admin->hasPermissionTo('members-ticket') || Employee::find($admin->id)?->can('members-ticket');
        // if ($technicalSupportTicket->supportable instanceof Subscriber) return $admin->hasPermissionTo('subscribers-ticket') || Employee::find($admin->id)?->can('viewAny-subscriber');
        // if ($technicalSupportTicket->supportable instanceof Volunteer) return $admin->hasPermissionTo('volunteers-ticket') || Employee::find($admin->id)?->can('viewAny-subscriber');

        return true;
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, TechnicalSupportTicket $technicalSupportTicket)
    {
        return $admin->hasPermissionTo('delete-ticket') || Employee::find($admin->id)?->can('delete-ticket');
    }
}
