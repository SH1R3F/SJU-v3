<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['userable_type', 'userable_id', 'answer_text', 'answer_date', 'answer_file', 'competition_field_id'];

    public function userable()
    {
        return $this->morphTo();
    }
}
