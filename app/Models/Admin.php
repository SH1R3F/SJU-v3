<?php

namespace App\Models;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';

    public const HOME = '/admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'mobile',
        'branch_id',
        'password',
        'active'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeFilter($query, Request $request)
    {
        return $query->when($request->search, fn ($builder, $search) => $builder->whereRaw("CONCAT(fname, ' ', lname) LIKE '%{$search}%'"))
            ->when($request->role, fn ($builder, $role) => $builder->whereHas('roles', fn ($query) => $query->where('id', $role)))
            ->when($request->branch, fn ($builder, $branch) => $builder->whereHas('branch', fn ($query) => $query->where('id', $branch)));
    }

    /**
     * fullname attribute
     */
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
