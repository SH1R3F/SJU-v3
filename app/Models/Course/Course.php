<?php

namespace App\Models\Course;

use App\Models\Branch;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Subscriber;
use App\Models\Course\Type;
use App\Models\Course\Place;
use Illuminate\Http\Request;
use App\Models\Course\Gender;
use App\Models\Course\Category;
use App\Models\Course\Template;
use App\Models\Course\Questionnaire;
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

    public const STATUS_HIDDEN = 0;
    public const STATUS_AVAILABLE = 1;
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
            2 => 'Registration ended',
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
            ->when($request->branch, fn ($builder, $branch) => $builder->where('course_branch_id', $branch))
            ->when($request->course_number, fn ($builder, $course_number) => $builder->where('course_number', "LIKE", "%$course_number%"))
            ->when($request->year, fn ($builder, $year) => $builder->whereYear('date_from', $year))
            ->when($request->month, fn ($builder, $month) => $builder->whereMonth('date_from', $month));
    }

    /**
     * Sort in admin panel
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeOrder($query, Request $request)
    {
        return $query->when(
            $request->order,
            function ($builder, $order) use ($request) {
                $direction = $request->dir == 'desc' ? 'DESC' : 'ASC';
                switch ($order) {
                    case 'title':
                        return $builder->orderBy(app()->getLocale() == 'ar' ? 'title_ar' : 'title_en', $direction);
                        break;
                    default:
                        $order = in_array($order, \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable())) ? $order : 'id';
                        return $builder->orderBy($order, $direction);
                        break;
                }
            },
            fn ($builder) => $builder->orderBy('created_at', 'DESC')
        );
    }

    /**
     * Relation to the template it belongs to
     */
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    /**
     * Relation to the questionnaire it belongs to
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
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
        return $this->belongsTo(Place::class, 'course_branch_id');
    }

    /**
     * Relation to the branch it belongs to
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'course_branch_id');
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

    /**
     * Relation to the coursables
     */
    public function members()
    {
        return $this->morphedByMany(Member::class, 'coursable')->withPivot('attendance');
    }

    public function subscribers()
    {
        return $this->morphedByMany(Subscriber::class, 'coursable')->withPivot('attendance');
    }

    public function volunteers()
    {
        return $this->morphedByMany(Volunteer::class, 'coursable')->withPivot('attendance');
    }


    /**
     * Relation to the questionables
     */
    public function questionable_members()
    {
        return $this->morphedByMany(Member::class, 'questionable');
    }

    public function questionable_subscribers()
    {
        return $this->morphedByMany(Subscriber::class, 'questionable');
    }

    public function questionable_volunteers()
    {
        return $this->morphedByMany(Volunteer::class, 'questionable');
    }
}
