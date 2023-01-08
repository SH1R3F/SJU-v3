<?php

namespace App\Models;

use App\Models\Subscription;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'member';

    public const HOME = '/members';

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
        'gender' => 'boolean',
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
    ];


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
        return '+201003384936'; // I hard code it for now
    }


    /**
     * Relation the the subscription a member has
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
}
