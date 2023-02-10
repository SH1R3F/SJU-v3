<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title_ar', 'title_en', 'image', 'images', 'summary_ar', 'summary_en', 'content_ar', 'content_en', 'admin_id', 'status', 'category_id', 'news_date'];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
    ];

    /**
     * Filter articles in admin panel
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        return $query
            ->when($request->title, function ($builder, $title) {
                return $builder->where(function ($query) use ($title) {
                    return $query
                        ->where('title_ar', 'LIKE', "%$title%")
                        ->orWhere('title_en', 'LIKE', "%$title%");
                });
            });
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
     * Relationship to the category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
