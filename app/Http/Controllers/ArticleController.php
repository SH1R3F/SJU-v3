<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{

    /**
     * Display articles
     * 
     * @return response
     */
    public function index()
    {
        dd('index');
    }

    /**
     * Display articles related to a category
     * 
     * @return response
     */
    public function category()
    {
        dd('category');
    }

    /**
     * Display a single article
     * 
     * @param \App\Models\Article  $article
     * @return response
     */
    public function show(Article $article)
    {
        $articles = Article::query()
            ->with('category')
            ->where('status', 1)
            ->whereNot('id', $article->id)
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();

        return inertia('Articles/View', [
            'article' => new ArticleResource($article),
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}
