<?php

namespace App\Models;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'invitation', 'invitation_id'];

    /**
     * Relation to the invitation it belongs to
     */
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
