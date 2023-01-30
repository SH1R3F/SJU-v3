<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar', 'title_en', 'image', 'images', 'summary_ar', 'summary_en', 'content_ar', 'content_en', 'admin_id', 'status', 'category_id'];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean'
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
}
