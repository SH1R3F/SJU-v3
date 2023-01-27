<?php

namespace App\Models\Course;

use App\Models\Course\Questionnaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $table = 'courses_questions';

    protected $fillable = ['questionnaire_id', 'question', 'commentable', 'answer1', 'color1', 'answer2', 'color2', 'answer3', 'color3', 'answer4', 'color4', 'order', 'status'];

    protected $casts = [
        'commentable' => 'boolean',
        'order' => 'integer',
        'status' => 'boolean',
    ];

    /**
     * Relation to the questionnaire it belongs to
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
    }
}
