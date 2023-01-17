<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Member;
use App\Models\TechnicalSupportTicket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TechnicalSupportPolicy
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
     * Determine whether the admin can view any tickets of members.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewMembers(Admin $admin)
    {
        return $admin->hasPermissionTo('members-ticket');
    }

    /**
     * Determine whether the admin can view any tickets of subscribers.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewSubscribers(Admin $admin)
    {
        return $admin->hasPermissionTo('subscribers-ticket');
    }

    /**
     * Determine whether the admin can view any tickets of volunteers.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewVolunteers(Admin $admin)
    {
        return $admin->hasPermissionTo('volunteers-ticket');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TechnicalSupportTicket  $technicalSupportTicket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, TechnicalSupportTicket $technicalSupportTicket)
    {
        if (!$admin->hasPermissionTo('view-ticket')) return false;

        if ($technicalSupportTicket->supportable instanceof Member) return $admin->hasPermissionTo('members-ticket');
        // if ($technicalSupportTicket->supportable instanceof Subscriber) return $admin->hasPermissionTo('subscribers-ticket');
        // if ($technicalSupportTicket->supportable instanceof Volunteer) return $admin->hasPermissionTo('volunteers-ticket');

        return true;
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TechnicalSupportTicket  $technicalSupportTicket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, TechnicalSupportTicket $technicalSupportTicket)
    {
        return $admin->hasPermissionTo('delete-ticket');
    }
}
