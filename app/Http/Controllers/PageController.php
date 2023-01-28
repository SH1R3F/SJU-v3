<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Http\Resources\CourseResource;

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

        return inertia('Home/Index', [
            'courses' => CourseResource::collection($courses)
        ]);
    }
}
