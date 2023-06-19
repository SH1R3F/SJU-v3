<?php

namespace App\Models;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'invitation', 'code', 'scanned', 'invitation_id'];

    /**
     * Relation to the invitation it belongs to
     */
    public function invitate()
    {
        return $this->belongsTo(Invitation::class, 'invitation_id');
    }
}
