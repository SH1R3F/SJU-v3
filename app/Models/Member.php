<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Certificate;
use Illuminate\Support\Facades\DB;
use App\Models\Course\Questionnaire;
use App\Models\TechnicalSupportTicket;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetMemberPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'member';

    public const HOME = '/members';

    /**
     * Member status values
     */
    public const STATUS_REFUSED    = -2;
    public const STATUS_DISABLED   = -1;
    public const STATUS_UNAPPROVED = 0;
    public const STATUS_APPROVED   = 1;
    public const STATUS_ACCEPTED   = 2;

    public const DELIVERY_OPTION_PICKUP   = 1;
    public const DELIVERY_OPTION_DELIVERY = 2;

    public const DELIVERY_STATUS_DEFAULT   = 0;
    public const DELIVERY_STATUS_DELIVERED = 1;

    public const GENDER_MALE   = 0;
    public const GENDER_FEMALE = 1;

    public const NEWSPAPER_PAPER      = 1;
    public const NEWSPAPER_ELECTRONIC = 2;

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
        'national_id' => 'integer',
        'national_id_date' => 'date:Y-m-d',
        'gender' => 'integer',
        'birthday_h' => 'date:Y-m-d',
        'birthday_m' => 'date:Y-m-d',
        'newspaper_type' => 'integer',
        'workphone' => 'integer',
        'workphone_ext' => 'integer',
        'fax' => 'integer',
        'fax_ext' => 'integer',
        'postbox' => 'integer',
        'postcode' => 'integer',
        'branch_id' => 'integer',
        'delivery_option' => 'integer',
        'delivery_status' => 'boolean',
        'mobile' => 'integer',
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'exp_flds_lngs' => 'array',
        'status' => 'integer'
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        Member::creating(function (Member $member) { // For multistep registration
            $member->mobile = str_starts_with($member->mobile, "966") ? $member->mobile : "966{$member->mobile}";
        });
    }

    /**
     * Filter members in admin panel
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

            // Filter by national id
            ->when($request->national_id, fn ($builder, $national_id) => $builder->where('national_id', 'LIKE', "%$national_id%"))
            // Filter by membership number
            ->when($request->membership_number, fn ($builder, $membership_number) => $builder->where('membership_number', 'LIKE', "%$membership_number%"))
            // Filter by mobile
            ->when($request->mobile, fn ($builder, $mobile) => $builder->where('mobile', 'LIKE', "%$mobile%"))
            // Filter by membership type
            ->when($request->type, fn ($builder, $type) => $builder->whereHas('subscription', function ($query) use ($type) {
                return $query->where('type', $type);
            }))
            // Filter by Branch
            ->when($request->branch, fn ($builder, $branch) => $builder->where('branch_id', $branch))
            // Filter by Year
            ->when($request->year, fn ($builder, $year) => $builder->whereYear('created_at', $year));
    }

    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    case 'name':
                        return $builder->orderByRaw(
                            app()->getLocale() == 'ar' ?
                                "CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) $direction" :
                                "CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) $direction"
                        );
                        break;
                    case 'membership_number':
                        return $builder->orderByRaw("REPLACE(membership_number, '-', '') $direction");
                        break;
                    case 'type':
                        return $builder->orderBy(function ($q) {
                            return $q->from('subscriptions')
                                ->whereRaw('`subscriptions`.member_id = `members`.id')
                                ->select('type');
                        }, $direction);
                        break;
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('updated_at', 'DESC')
        );
    }

    /**
     * Arabic fullname attribute
     */
    public function getFullNameAttribute()
    {
        return app()->getLocale() == 'ar' ? "{$this->fname_ar} {$this->sname_ar} {$this->tname_ar} {$this->lname_ar}" : "{$this->fname_en} {$this->sname_en} {$this->tname_en} {$this->lname_en}";
    }

    /**
     * Arabic fullname attribute
     */
    public function getFullNameArAttribute()
    {
        return "{$this->fname_ar} {$this->sname_ar} {$this->tname_ar} {$this->lname_ar}";
    }

    /**
     * English fullname attribute
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
        return "+{$this->mobile}";
    }


    /**
     * Relation the the subscription a member has
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * Relation the the branch the member belongs to
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Relation the the transactions the member has made
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Relation the the invoices the member has made
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Did the member complete his profile with full information?
     * @return bool
     */
    public function complete()
    {
        return !is_null($this->newspaper_type) &&
            !is_null($this->profile_photo) &&
            !is_null($this->national_id_photo) &&
            !is_null($this->statement_photo) &&
            !($this->newspaper_type == 2 && is_null($this->license_photo)) &&
            !($this->subscription?->type == 3 && is_null($this->contract_photo)) &&
            $this->exp_flds_lngs_complete();
    }

    /**
     * Did the member complete his experiences, fields & languages with full information?
     * @return bool
     */
    public function exp_flds_lngs_complete()
    {
        if (!$this->exp_flds_lngs) return false;
        if (!count($this->exp_flds_lngs['fields'])) return false;
        if (!count($this->exp_flds_lngs['languages'])) return false;
        if (!count($this->exp_flds_lngs['experiences'])) return false;
        return true;
    }

    /**
     * Check if member can access payment routes
     * @return bool
     */
    public function canPay()
    {
        return is_null($this->subscription?->end_date) ||
            (!is_null($this->subscription?->end_date) && $this->subscription?->end_date?->lt(Carbon::today())) ||
            $this->subscription?->status !== Subscription::SUBSCRIPTION_ACTIVE;
    }

    /**
     * Membership status in readable way
     */
    public function status()
    {
        switch ($this->status) {
            case self::STATUS_ACCEPTED:
                if ($this->subscription?->status == Subscription::SUBSCRIPTION_ACTIVE) {
                    if ($this->subscription?->end_date?->lt(Carbon::today())) return __('Expired');
                    return __('Active');
                }
                return __('Waiting paying');
                break;

            case self::STATUS_APPROVED:
                return __('Waiting admin approval');
                break;

            case self::STATUS_UNAPPROVED:
                if ($this->complete()) {
                    return __('Waiting branch approval');
                } else {
                    return __("Didn't complete info");
                }
                break;

            case self::STATUS_REFUSED:
                return __('Membership refused');
                break;

            case self::STATUS_DISABLED:
                return __('Disabled');
                break;

            default:
                return null;
                break;
        }
    }

    public function activeMember()
    {
        return $this->status === self::STATUS_ACCEPTED
            && $this->subscription?->status == Subscription::SUBSCRIPTION_ACTIVE
            && !$this->subscription?->end_date?->lt(Carbon::today());
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
     * Relation to the competition submissions he has
     */
    public function submissions()
    {
        return $this->morphMany(CompetitionSubmittion::class, 'userable');
    }

    /**
     * Relation to the certificates he has
     */
    public function certificates()
    {
        return $this->morphMany(Certificate::class, 'certificatable');
    }

    /**
     * Relation to the vote he has
     */
    public function vote()
    {
        return $this->hasOne(Vote::class, 'voter_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetMemberPassword($token));
    }
}
