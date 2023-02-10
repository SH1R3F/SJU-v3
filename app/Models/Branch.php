<?php

namespace App\Models;

use App\Models\Volunteer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    /**
     * Relation the the admins the branch has to
     */
    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * Relation the the members the branch has to
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Relation the the volunteers the branch has to
     */
    public function volunteers(): HasMany
    {
        return $this->hasMany(Volunteer::class);
    }

    // Courses too
}
