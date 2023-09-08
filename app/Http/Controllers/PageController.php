<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Page;
use App\Models\Media;
use App\Models\Member;
use App\Models\Article;
use App\Models\TrainingBag;
use App\Models\Subscription;
use App\Models\Course\Course;
use App\Services\PageService;
use App\Http\Resources\AdResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\MediaResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\TrainingBagResource;

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

        $articles = Article::with('category')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(9)
            ->get();

        $ads = Ad::where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(9)
            ->get();

        return inertia('Home/Index', [
            'courses' => CourseResource::collection($courses),
            'articles' => ArticleResource::collection($articles),
            'ads' => AdResource::collection($ads),
            'media' => MediaResource::collection(Media::orderBy('type', 'ASC')->paginate(9, ['*'], 'media')),
            'photos' => MediaResource::collection(Media::where('type', 'photo')->orderBy('id', 'DESC')->paginate(9, ['*'], 'photos')),
            'videos' => MediaResource::collection(Media::where('type', 'video')->orderBy('id', 'DESC')->paginate(9, ['*'], 'videos')),
            'stats' => [
                'members' => Member::where('status', 2)->count(),
                'memberships' => Subscription::where('status', 1)->count(),
                'courses' => Course::whereIn('status', [1, 2, 3, 4])->count(),
            ]
        ]);
    }

    /**
     * Show a page by slug
     */
    public function page($slug, PageService $service)
    {
        $page = Page::where('slug_ar', $slug)->orWhere('slug_en', $slug)->firstOrFail();

        return inertia('Pages/View', [
            'page' => new PageResource($page),

        ]);
    }

    /**
     * Display the training bag page
     */
    public function trainingBag()
    {
        $bags = TrainingBag::latest()
            ->paginate(18);

        return inertia('Pages/TrainingBag', [
            'bags' => TrainingBagResource::collection($bags),
        ]);
    }

    /**
     * Display the Studio page
     */
    public function studio()
    {
        $studio = Media::latest()->paginate(18);

        return inertia('Pages/Studio', [
            'studio' => MediaResource::collection($studio),
            'media' => MediaResource::collection(Media::orderBy('type', 'ASC')->paginate(9, ['*'], 'media')),
            'photos' => MediaResource::collection(Media::where('type', 'photo')->orderBy('id', 'DESC')->paginate(9, ['*'], 'photos')),
            'videos' => MediaResource::collection(Media::where('type', 'video')->orderBy('id', 'DESC')->paginate(9, ['*'], 'videos')),
        ]);
    }
}
