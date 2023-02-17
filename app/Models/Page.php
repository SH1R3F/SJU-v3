<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title_ar', 'title_en', 'slug_ar', 'slug_en', 'content_ar', 'content_en', 'status', 'admin_id'];

    protected $casts = [
        'status' => 'boolean'
    ];


    /**
     * Filter pages in admin panel
     * @param \Illuminate\Http\Request  $request
     */
    public function scopeFilter($query, Request $request)
    {
        return $query
            ->when($request->name, function ($builder, $name) {
                return $builder->where(function ($query) use ($name) {
                    return $query
                        ->where('name_ar', 'LIKE', "%$name%")
                        ->orWhere('name_en', 'LIKE', "%$name%");
                });
            })
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
                    case 'slug':
                        return $builder->orderBy(app()->getLocale() == 'ar' ? 'slug_ar' : 'slug_en', $direction);
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

    public function getContentAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->content_ar : $this->content_en;
    }
}
