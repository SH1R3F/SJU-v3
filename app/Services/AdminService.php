<?php

namespace App\Services;

use App\Models\Admin;


class AdminService
{

    /**
     * Store a newly created admin with its permissions
     */
    public function store(array $data)
    {
        // Hash password
        $data['password'] = bcrypt($data['password']);

        // Store
        $admin = Admin::create($data);

        // Assign role
        $admin->assignRole($data['role']);

        // Return
        return $admin;
    }

    /**
     * Update an admin with its role and branch
     */
    public function update(array $data, Admin $admin)
    {
        // Hash password
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        // Update
        $admin->update($data);

        // Assign role BUT role should never be updated for superadmin (admin with id of 1)
        if ($admin->id !== 1) $admin->syncRoles([$data['role']]);
    }

    /**
     * Prepare the recipients of a single notification
     */
    public function prepareRecipients(array $data)
    {
        switch ($data['to_type']) {
            case 'select':
                return Admin::whereIn('id', $data['recipients'])->whereHas('roles', fn($query) => $query->whereNot('name', 'Employee'))->get();
                break;
            case 'all':
                return Admin::where('active', 1)->whereHas('roles', fn($query) => $query->whereNot('name', 'Employee'))->get();
                break;
            default:
                return Admin::where('active', 1)->whereHas('roles', fn($query) => $query->whereNot('name', 'Employee'))->whereHas('roles', fn ($query) => $query->where('name', $data['to_type']))->get();
                break;
        }
    }
}
