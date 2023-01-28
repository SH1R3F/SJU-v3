<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'course_id'];

    /**
     * Relation to the certificatable
     */
    public function certificatable()
    {
        return $this->morphTo();
    }
}
