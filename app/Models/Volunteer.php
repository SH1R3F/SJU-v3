<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Certificate;
use App\Notifications\VerifyEmail;
use App\Models\Course\Questionnaire;
use App\Models\TechnicalSupportTicket;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetVolunteerPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Volunteer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $guard = 'volunteer';

    public const HOME = '/volunteers';

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
        'mobile' => 'integer',
        'mobile_key' => 'integer',
        'status' => 'integer',
        'national_id' => 'integer',
        'branch_id' => 'integer',
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
                        ->where(DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)"), 'LIKE', "%$name%")
                        ->orWhere(DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"), 'LIKE', "%$name%");
                });
            })
            // Filter by mobile
            ->when($request->mobile, fn ($builder, $mobile) => $builder->where(DB::raw("CONCAT(mobile_key, mobile)"), 'LIKE', "%$mobile%"))
            // Filter by national id
            ->when($request->national_id, fn ($builder, $national_id) => $builder->where('national_id', 'LIKE', "%$national_id%"))
            // Filter by city
            ->when($request->branch, function ($builder, $branch) {
                // Operator precedence
                return $builder->where(function ($query) use ($branch) {
                    return $query
                        ->where('branch_id', $branch)
                        ->orWhere('city', $branch);
                });
            })
            // Filter by fields
            ->when($request->field, fn ($builder, $field) => $builder->where('fields', 'LIKE', "%$field%"));
    }

    /**
     * Fullname attribute
     */
    public function getFullNameAttribute()
    {
        return app()->getLocale() == 'ar' ? "{$this->fname_ar} {$this->sname_ar} {$this->tname_ar} {$this->lname_ar}" : "{$this->fname_en} {$this->sname_en} {$this->tname_en} {$this->lname_en}";
    }

    /**
     * Fullname (Arabic) attribute
     */
    public function getFullNameArAttribute()
    {
        return "{$this->fname_ar} {$this->sname_ar} {$this->tname_ar} {$this->lname_ar}";
    }

    /**
     * Fullname (English) attribute
     */
    public function getFullNameEnAttribute()
    {
        return "{$this->fname_en} {$this->sname_en} {$this->tname_en} {$this->lname_en}";
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

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
            'status' => self::STATUS_ACTIVE,
        ])->save();
    }

    /**
     * Relation the the branch the member belongs to
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetVolunteerPassword($token));
    }
}
