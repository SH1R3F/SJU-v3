<?php

namespace App\Models\Course;

use App\Models\Course\Type;
use App\Models\Course\Place;
use Illuminate\Http\Request;
use App\Models\Course\Gender;
use App\Models\Course\Category;
use App\Models\Course\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'seats' => 'integer',
        'days' => 'array',
        'minutes' => 'integer',
        'percentage' => 'integer',
        'cost' => 'integer',
        'price' => 'integer',
        'payment_method' => 'integer',
        'images' => 'array',
        'status' => 'integer',
    ];

    public const STATUS_AVAILABLE = 1;
    public const STATUS_HIDDEN = 0;
    public const STATUS_ENDED = 2;
    public const STATUS_POSTPONED = 3;
    public const STATUS_COMPLETED = 4;
    public const STATUS_PRIVATE = 5;

    /**
     * Readble Statuses
     */
    public function state($status)
    {
        $statuses = [
            0 => 'Hidden',
            1 => 'Available',
            2 => 'Ended',
            3 => 'Postponed',
            4 => 'Completed',
            5 => 'Private',
        ];
        if (!in_array($status, array_keys($statuses))) return '';
        return $statuses[$status];
    }

    public function scopeFilter($query, Request $request)
    {
        return $query->when($request->title, fn ($builder, $title) => $builder->where(function ($query) use ($title) {
            return $query->where('title_ar', 'LIKE', '%' . $title . '%')
                ->orWhere('title_en', 'LIKE', '%' . $title . '%');
        }))
            ->when($request->region, fn ($builder, $region) => $builder->where('region', "LIKE", "%$region%"))
            ->when($request->course_number, fn ($builder, $course_number) => $builder->where('course_number', "LIKE", "%$course_number%"))
            ->when($request->year, fn ($builder, $year) => $builder->whereYear('date_from', $year))
            ->when($request->month, fn ($builder, $month) => $builder->whereMonth('date_from', $month));
    }

    /**
     * Relation to the template it belongs to
     */
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    /**
     * Relation to the type it belongs to
     */
    public function type()
    {
        return $this->belongsTo(Type::class, 'course_type_id');
    }

    /**
     * Relation to the place it belongs to
     */
    public function place()
    {
        return $this->belongsTo(Place::class, 'course_place_id');
    }

    /**
     * Relation to the gender it belongs to
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'course_gender_id');
    }

    /**
     * Relation to the category it belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'course_category_id');
    }
}
