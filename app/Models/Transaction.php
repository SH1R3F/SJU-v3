<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public const STATUS_FAILED  = -1;
    public const STATUS_SUCCESS = 1;
    public const STATUS_EXPIRED = 2;
    public const STATUS_PENDING = 3;

    protected $fillable = [
        'checkout_id',
        'payment_method',
        'member_id',
        'response',
        'cart_ref'
    ];

    protected $casts = [
        'payment_method' => 'integer'
    ];

    /**
     * Relationship to members that made this transaction
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Response messages
     * 
     * @param int  $status
     */
    public static function responses(int $status)
    {
        $statuses = [
            self::STATUS_FAILED => __('Transaction declined. Payment was not completed'),
            self::STATUS_SUCCESS => __('Payment has been completed'),
            self::STATUS_EXPIRED => __('Payment request expired. Please try again or contact us.'),
            self::STATUS_PENDING => __('The process is pending please verify and contact us'),
        ];

        return $statuses[$status];
    }
}
