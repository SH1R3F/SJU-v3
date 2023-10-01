<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\TechnicalSupportTicket;
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
        'fname_ar',
        'lname_ar',
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
        return $query->when($request->search, fn ($builder, $search) => $builder->whereRaw("CONCAT(fname_ar, ' ', lname_ar) LIKE '%{$search}%'"))
            ->when($request->role, fn ($builder, $role) => $builder->whereHas('roles', fn ($query) => $query->where('id', $role)))
            ->when($request->branch, fn ($builder, $branch) => $builder->whereHas('branch', fn ($query) => $query->where('id', $branch)));
    }

    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    case 'role':
                        return $builder->orderBy(function ($q) {
                            return $q->from('model_has_roles')
                                ->whereRaw("`model_has_roles`.model_id = `admins`.id")
                                ->select('role_id');
                        }, $direction);
                        break;
                    case 'name':
                        return $builder->orderByRaw("CONCAT(fname_ar, ' ', lname_ar) $direction");
                        break;
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('id', 'ASC')
        );
    }

    /**
     * fullname attribute
     */
    public function getFullNameAttribute()
    {
        return "{$this->fname_ar} {$this->lname_ar}";
    }

    /**
     * Prepare mobile number for sms to use
     */
    public function prepareMobileForSms()
    {
        return "+{$this->mobile}";
    }


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Technical support tickets relationship
     */
    public function tickets()
    {
        return $this->morphMany(TechnicalSupportTicket::class, 'supportable');
    }
}
