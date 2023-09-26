<?php

namespace App\Models;


class Employee extends Admin
{
    protected $table = 'admins';

    public function newQuery() {
        return parent::newQuery()->whereHas('roles', fn ($query) => $query->where('name', 'Employee'));
    }
}
