<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembershipTransfer extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'transfer_from', 'transfer_to', 'status', 'request_by', 'action_by'];

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = -1;

    /**
     * Filter transfers in admin panel
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        // TODO: Add filters
        return $query;
    }

    /**
     * Sort in admin panel
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeOrder($query, Request $request)
    {
        // TODO: Add order rules
        return $query->orderBy('id', 'DESC');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function branchFrom()
    {
        return $this->belongsTo(Branch::class, 'transfer_from');
    }

    public function branchTo()
    {
        return $this->belongsTo(Branch::class, 'transfer_to');
    }

    public function requester()
    {
        return $this->belongsTo(Admin::class, 'request_by');
    }

    public function accepter()
    {
        return $this->belongsTo(Admin::class, 'action_by');
    }

    public function state()
    {
        return match($this->status) {
            0 => __('Waiting approval'),
            1 => __('Transferred'),
            -1 => __('Disapproved'),
            default => null
        };
    }
}
