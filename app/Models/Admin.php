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

    public function scopeOrder($query, Request $request)
    {
        return $query->when($request->order, function ($builder, $order) use ($request) {
            $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
            switch ($order) {
                case 'role':
                    return $builder->whereHas('roles', fn ($builder) => $builder->orderBy('name', $direction));
                    break;
                case 'name':
                    return $builder->orderByRaw("CONCAT(fname, ' ', lname) $direction");
                    break;
                default:
                    $order = in_array($order, $this->fillable) ? $order : 'id';
                    return $builder->orderBy($order, $direction);
                    break;
            }
        });
    }

    /**
     * fullname attribute
     */
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    /**
     * Prepare mobile number for sms to use
     */
    public function prepareMobileForSms()
    {
        // Make sure mobile is in format +[Key][Number]
        return '+201003384936'; // I hard code it for now
    }


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
