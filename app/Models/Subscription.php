<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\Invoice;
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
     * Relation the the invoices it has
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
