<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course\Course;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ArticleResource;

class PageController extends Controller
{
    /**
     * The home page of website
     */
    public function home()
    {
        $courses = Course::query()
            ->whereIn('status', [1, 2, 3, 4])
            ->whereDate('date_from', '>=', now())
            ->orderBy('date_from', 'ASC')
            ->take(2)
            ->get();

        $articles = Article::query()
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(9)
            ->get();

        return inertia('Home/Index', [
            'courses' => CourseResource::collection($courses),
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}
