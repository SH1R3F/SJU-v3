<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionField extends Model
{
    use HasFactory;

    public const TYPE_TEXT = 'text';
    public const TYPE_DATE = 'date';
    public const TYPE_FILE = 'file';

    protected $fillable = ['title', 'type', 'required', 'competition_id'];

    protected $casts = [
        'required' => 'boolean'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function answers()
    {
        return $this->hasMany(CompetitionAnswer::class);
    }
}
