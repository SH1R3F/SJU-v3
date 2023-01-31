<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title_ar', 'title_en'];

    /**
     * Relationship to articles
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
