<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Certificate;
use Illuminate\Support\Facades\DB;
use App\Models\Course\Questionnaire;
use App\Models\TechnicalSupportTicket;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Subscriber extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'subscriber';

    public const HOME = '/subscribers';

    public const STATUS_INACTIVE = -1;
    public const STATUS_DISABLED = 0;
    public const STATUS_ACTIVE = 1;


    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'city' => 'integer',
        'qualification' => 'integer',
        'hearabout' => 'integer',
        'mobile_key' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Filter subscribers in admin panel
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        return $query
            // Filter Full Name [ar, en]
            ->when($request->name, function ($builder, $name) {
                // Operator precedence
                return $builder->where(function ($query) use ($name) {
                    return $query
                        ->where(DB::raw("CONCAT(fname, ' ', sname, ' ', tname, ' ', lname)"), 'LIKE', "%$name%");
                });
            })
            // Filter by mobile
            ->when($request->mobile, fn ($builder, $mobile) => $builder->where(DB::raw("CONCAT(mobile_key, mobile)"), 'LIKE', "%$mobile%"));
    }

    /**
     * Fullname attribute
     */
    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->sname} {$this->tname} {$this->lname}";
    }

    /**
     * Prepare mobile number for sms to use
     */
    public function prepareMobileForSms()
    {
        // Make sure mobile is in format +[Key][Number]
        return "+{$this->mobile_key}{$this->mobile}";
    }

    /**
     * Technical support tickets relationship
     */
    public function tickets()
    {
        return $this->morphMany(TechnicalSupportTicket::class, 'supportable');
    }

    /**
     * Relationship to the courses it has
     */
    public function courses()
    {
        return $this->morphToMany(Course::class, 'coursable')->withPivot('attendance');
    }

    /**
     * Relationship to the questionnaires it has
     */
    public function questionnaires()
    {
        return $this->morphToMany(Questionnaire::class, 'questionable')->withPivot('answers');
    }

    /**
     * Relation to the certificates he has
     */
    public function certificates()
    {
        return $this->morphMany(Certificate::class, 'certificatable');
    }
}
