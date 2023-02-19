<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::query()
            ->filter(request())
            ->addSelect([
                'article_category' => Category::select(app()->getLocale() == 'ar' ? 'title_ar' : 'title_en')->whereColumn('categories.id', 'articles.category_id')->take(1),
            ])
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/News/Articles/Index', [
            'articles' => ArticleResource::collection($articles)
                ->additional([
                    'can_create' => request()->user()->can('create', Article::class),
                ]),
            'filters' => request()->only(['perPage', 'title', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/News/Articles/Create', [
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, ArticleService $service)
    {
        // Store it
        $service->create($request->validated());

        // Redirect to index.
        return redirect()->route('admin.articles.index')->with('message', __('Article created successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @param  \App\Services\ArticleService  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return inertia('Admin/News/Articles/Edit', [
            'article' => new ArticleResource($article),
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @param  \App\Services\ArticleService  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article, ArticleService $service)
    {
        // Store it
        $service->update($request->validated(), $article);

        // Redirect to index.
        return redirect()->route('admin.articles.index')->with('message', __('Article updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->back()->with('message', __('Article deleted successfully'));
    }
}
