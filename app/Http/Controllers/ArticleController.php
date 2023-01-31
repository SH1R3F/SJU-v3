<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;

class ArticleController extends Controller
{

    /**
     * Display articles
     * 
     * @param int  $category_id
     * @return response
     */
    public function articles($category_id = null)
    {
        $articles = Article::query()
            ->with('category')
            ->when($category_id, fn ($query) => $query->where('category_id', $category_id))
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->paginate(18);

        $categories = Category::where('status', 1)->orderBy('order')->orderBy('id')->get();

        return inertia('Articles/Index', [
            'categories' => CategoryResource::collection($categories),
            'articles' => ArticleResource::collection($articles),
            'category_id' => $category_id ?? '0'
        ]);
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
