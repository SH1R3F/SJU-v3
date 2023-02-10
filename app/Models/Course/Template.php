<?php

namespace App\Models\Course;

use Illuminate\Http\Request;
use App\Models\Course\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    protected $table = 'courses_templates';

    protected $fillable = ['name', 'layout', 'qr_position', 'qr_position', 'qr_margin_top', 'qr_margin_right', 'qr_margin_bottom', 'qr_margin_left', 'with_title', 'male_title', 'female_title', 'mode', 'variables', 'file', 'preview'];

    protected $casts = [
        'with_title' => 'boolean',
        'variables' => 'array'
    ];

    public function scopeFilter($query, Request $request)
    {
        return $query->when($request->search, fn ($builder, $search) => $builder->where('name', 'LIKE', "%$search%"));
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
            fn ($builder) => $builder->orderBy('created_at', 'DESC')
        );
    }

    /**
     * Relation to the courses it has
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'template_id');
    }
}
