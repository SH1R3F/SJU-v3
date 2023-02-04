<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title_ar', 'title_en'];

    /**
     * Filter categories in admin panel
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
     * Relationship to articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
