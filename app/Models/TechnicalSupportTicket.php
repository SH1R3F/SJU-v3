<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TechnicalSupportMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin;

class TechnicalSupportTicket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'supportable_type', 'supportable_id'];
    protected $casts = ['status' => 'boolean'];

    public const STATUS_OPEN   = 0;
    public const STATUS_CLOSED = 1;

    public const SENDER_ADMIN = 1;
    public const SENDER_USER  = 0;

    /**
     * Filtering
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        return $query
            // Filter by title
            ->when($request->title, fn ($builder, $title) => $builder->where('title', 'LIKE', "%$title%"))
            // Filter Full Name [ar, en]
            ->when($request->name, function ($builder, $name) {
                return $builder->whereHas('supportable', function ($query) use ($name) {
                    return $query
                        ->where(DB::raw("CONCAT(IFNULL(CONCAT(fname_ar, ' '), ''), IFNULL(CONCAT(sname_ar, ' '), ''), IFNULL(CONCAT(tname_ar, ' '), ''), lname_ar)"), 'LIKE', "%$name%")
                        ->orWhere(DB::raw("CONCAT(IFNULL(CONCAT(fname_en, ' '), ''), IFNULL(CONCAT(sname_en, ' '), ''), IFNULL(CONCAT(tname_en, ' '), ''), lname_en)"), 'LIKE', "%$name%");
                });
            })
            // Filter by status
            ->when($request->status, fn ($builder, $status) => $builder->where('status', $status))
            // Filter by mobile
            ->when($request->mobile, fn ($builder, $mobile) => $builder->whereHas('supportable', function ($builder) use ($mobile) {
                return $builder->where('mobile', 'LIKE', "%$mobile%");
            }))
            // Filter by email
            ->when($request->email, fn ($builder, $email) => $builder->whereHas('supportable', function ($builder) use ($email) {
                return $builder->where('email', 'LIKE', "%$email%");
            }));
    }

    /**
     * Sort in admin panel
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    case 'member':
                        return $builder->orderBy(function ($q) {
                            return $q->from('members')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `members`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Member'")
                                ->selectRaw(
                                    app()->getLocale() == 'ar' ?
                                        "CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)" :
                                        "CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"
                                );
                        }, $direction);
                        break;
                    case 'member_mobile':
                        return $builder->orderBy(function ($q) {
                            return $q->from('members')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `members`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Member'")
                                ->select('mobile');
                        }, $direction);
                        break;
                    case 'subscriber':
                        return $builder->orderBy(function ($q) {
                            return $q->from('subscribers')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `subscribers`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Subscriber'")
                                ->selectRaw(
                                    app()->getLocale() == 'ar' ?
                                        "CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)" :
                                        "CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"
                                );
                        }, $direction);
                        break;
                    case 'subscriber_mobile':
                        return $builder->orderBy(function ($q) {
                            return $q->from('subscribers')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `subscribers`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Subscriber'")
                                ->selectRaw('CONCAT(mobile_key, mobile)');
                        }, $direction);
                        break;
                    case 'volunteer':
                        return $builder->orderBy(function ($q) {
                            return $q->from('volunteers')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `volunteers`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Volunteer'")
                                ->selectRaw(
                                    app()->getLocale() == 'ar' ?
                                        "CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)" :
                                        "CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"
                                );
                        }, $direction);
                        break;
                    case 'volunteer_mobile':
                        return $builder->orderBy(function ($q) {
                            return $q->from('volunteers')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `volunteers`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Volunteer'")
                                ->selectRaw('CONCAT(mobile_key, mobile)');
                        }, $direction);
                        break;
                    case 'manager':
                        return $builder->orderBy(function ($q) {
                            return $q->from('admins')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `admins`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Admin'")
                                ->selectRaw("CONCAT(IFNULL(CONCAT(fname_ar, ' '), ''), IFNULL(CONCAT(sname_ar, ' '), ''), IFNULL(CONCAT(tname_ar, ' '), ''), lname_ar)");
                        }, $direction);
                        break;
                    case 'manager_mobile':
                        return $builder->orderBy(function ($q) {
                            return $q->from('admins')
                                ->whereRaw("`technical_support_tickets`.supportable_id = `admins`.id AND `technical_support_tickets`.supportable_type = 'App\\\Models\\\Admin'")
                                ->select('mobile');
                        }, $direction);
                        break;
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'updated_at';
                        $direction = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $direction : 'DESC';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('updated_at', 'DESC')
        );
    }

    /**
     * Relationship to model that owns this ticket
     */
    public function supportable()
    {
        return $this->morphTo();
    }

    /**
     * Relationship to the messages belongs to this ticket
     */
    public function messages()
    {
        return $this->hasMany(TechnicalSupportMessage::class, 'ticket_id');
    }
}
