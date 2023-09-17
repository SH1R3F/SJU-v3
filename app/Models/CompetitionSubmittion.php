<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionSubmittion extends Model
{
    use HasFactory;

    protected $fillable = ['userable_type', 'userable_id', 'competition_id'];

    public function userable()
    {
        return $this->morphTo();
    }

    public function answers()
    {
        return $this->hasMany(CompetitionAnswer::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
