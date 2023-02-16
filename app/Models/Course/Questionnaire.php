<?php

namespace App\Models\Course;

use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Questionnaire extends Model
{
    use HasFactory;

    protected $table = 'courses_questionnaires';

    protected $fillable = ['name_ar', 'name_en', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeFilter($query, Request $request)
    {
        return $query->when($request->search, fn ($builder, $search) => $builder->where('name_ar', 'LIKE', "%$search%")->orWhere('name_en', 'LIKE', "%$search%"));
    }

    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('id', 'DESC')
        );
    }

    /**
     * Relation to the courses it has
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'questionnaire_id');
    }

    /**
     * Relation to the questions it has
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'questionnaire_id');
    }

    /**
     * Relation to the questionables
     */
    public function members()
    {
        return $this->morphedByMany(Member::class, 'questionable');
    }

    public function subscribers()
    {
        return $this->morphedByMany(Subscriber::class, 'questionable');
    }

    public function volunteers()
    {
        return $this->morphedByMany(Volunteer::class, 'questionable');
    }
}
