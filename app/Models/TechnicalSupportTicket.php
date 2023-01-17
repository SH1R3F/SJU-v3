<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TechnicalSupportMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnicalSupportTicket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status'];
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
                // Operator precedence
                return $builder->whereHas('supportable', function ($query) use ($name) {
                    return $query
                        ->where(DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar)"), 'LIKE', "%$name%")
                        ->orWhere(DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en)"), 'LIKE', "%$name%");
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
