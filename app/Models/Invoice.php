<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'member_id', 'subscription_id', 'amount', 'order_data'];

    protected $casts = [
        'amount' => 'float',
        'order_data' => 'array'
    ];

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

    /**
     * The relation to the member made this invoice 
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * The relation to the subscription this invoice belongs to 
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
