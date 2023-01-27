<?php

namespace App\Models\Course;

use App\Models\Course\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    /**
     * Relation to the template it belongs to
     */
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}
