<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'type', 'start_date', 'end_date', 'status'];

    protected $casts = [
        'type' => 'integer',
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'status' => 'integer',
    ];

    public const SUBSCRIPTION_ACTIVE   = 1;
    public const SUBSCRIPTION_INACTIVE = 0;
    public const SUBSCRIPTION_NEW      = -1;


    /**
     * Relation the the member it belongs to
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Membership status in readable way
     */
    public function status()
    {
        switch ($this->status) {
            case self::SUBSCRIPTION_ACTIVE:
                return __('Active');
                break;

            default:
                switch ($this->member->status) {
                    case Member::STATUS_ACCEPTED:
                        return __('Waiting paying');
                        break;

                    case Member::STATUS_APPROVED:
                        return __('Waiting admin approval');
                        break;

                    case Member::STATUS_UNAPPROVED:
                        return __('Waiting branch approval');
                        break;

                    case Member::STATUS_REFUSED:
                        return __('Membership refused');
                        break;

                    default:
                        return null;
                        break;
                }
                break;
        }
    }
}
