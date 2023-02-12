<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'payment_method' => 'integer',
        'response' => 'array'
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

    /**
     * Filtering
     * 
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        return $query
            // Filter Full Name [ar, en]
            ->when($request->name, function ($builder, $name) {
                // Operator precedence
                return $builder->whereHas('member', function ($query) use ($name) {
                    return $query
                        ->where(DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)"), 'LIKE', "%$name%")
                        ->orWhere(DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"), 'LIKE', "%$name%");
                });
            })
            // Filter by national id
            ->when($request->national_id, fn ($builder, $national_id) => $builder->whereHas('member', function ($builder) use ($national_id) {
                return $builder->where('national_id', 'LIKE', "%$national_id%");
            }))
            // Filter by membership number
            ->when($request->membership_number, fn ($builder, $membership_number) => $builder->whereHas('member', function ($builder) use ($membership_number) {
                return $builder->where('membership_number', 'LIKE', "%$membership_number%");
            }));
    }


    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    case 'name':
                        return $builder->orderBy(function ($q) {
                            return $q->from('members')
                                ->whereRaw('`members`.id = `invoices`.member_id')
                                ->selectRaw(
                                    app()->getLocale() == 'ar' ?
                                        "CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)" :
                                        "CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"
                                );
                        }, $direction);
                        break;
                    case 'membership_number':
                        return $builder->orderBy(function ($q) {
                            return $q->from('members')
                                ->whereRaw('`members`.id = `invoices`.member_id')
                                ->selectRaw("REPLACE(membership_number, '-', '')");
                        }, $direction);
                        break;
                    case 'type':
                        return $builder->orderBy(function ($q) {
                            return $q->from('subscriptions')
                                ->whereRaw('`subscriptions`.id = `invoices`.subscription_id')
                                ->select('type');
                        }, $direction);
                        break;
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('created_at', 'DESC')
        );
    }
}
