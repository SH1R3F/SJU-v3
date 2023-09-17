<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answer_text', 'answer_date', 'answer_file', 'competition_submittion_id', 'competition_field_id'];

    public function submission()
    {
        return $this->belongsTo(CompetitionSubmission::class);
    }

    public function competition_field()
    {
        return $this->belongsTo(CompetitionField::class);
    }
}
