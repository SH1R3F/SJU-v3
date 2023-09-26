<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;


class Employee extends Admin
{
    use HasRoles;

    protected $table = 'admins';
    protected $guard_name = 'admin';

    public function newQuery() {
        return parent::newQuery()->whereHas('roles', fn ($query) => $query->where('name', 'Employee'));
    }
}
