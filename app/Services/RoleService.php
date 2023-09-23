<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{

    /**
     * Store a newly created role with its permissions
     */
    public function store(array $data)
    {
        // Store
        $role = Role::create($data + ['guard_name' => 'admin']);

        // Assign permissions
        $role->syncPermissions($data['permissions']);

        // Return
        return $role;
    }

    /**
     * Update a role with its permissions
     */
    public function update(array $data, Role $role)
    {

        // The basic role names can't be changed
        if (in_array($role->name, ['Site admin', 'Branch manager', 'News editor', 'Employee'])) unset($data['name']);

        // Update
        $role->update($data);

        // Assign permissions
        $role->syncPermissions($data['permissions']);
    }
}
