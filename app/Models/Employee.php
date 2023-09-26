<?php

namespace App\Models;


class Employee extends Admin
{
    protected $table = 'admins';
    protected $guard_name = 'admin';

    public function newQuery() {
        return parent::newQuery()->whereHas('roles', fn ($query) => $query->where('name', 'Employee'));
    }
}
