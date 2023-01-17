<?php

namespace App\Models;

use App\Models\TechnicalSupportTicket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnicalSupportMessage extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'body', 'attachment', 'sender'];

    protected $casts = ['sender' => 'boolean'];

    public const SENDER_ADMIN = 1;
    public const SENDER_USER  = 0;


    /**
     * Relationship to the ticket it belongs to.
     */
    public function ticket()
    {
        return $this->belongsTo(TechnicalSupportTicket::class, 'ticket_id');
    }
}
