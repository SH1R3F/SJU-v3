<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Course::class, 'course');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::query()
            // ->filter(request())
            ->orderBy('id')
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Courses/Index', [
            'courses' => CourseResource::collection($courses)
                ->additional([
                    'can_create' => request()->user()->can('create', Course::class),
                ]),
            'filters' => request()->only(['perPage', 'title', 'course_number', 'year', 'month', 'region'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return inertia('Admin/Courses/Create', [
            'types' => [],
            'genders' => [],
            'categories' => [],
            'locations' => [],
            'templates' => [],
            'questionnaires' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Toggle active status for a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request, Course $course)
    {
        $this->authorize('toggle', $course);

        $course->update(['status' => $state = $course->active == 2 ? 1 : 2]);
        return redirect()->back()->with('message', __($state == 2 ? 'Course hidden successfully' : 'Course enabled successfully'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        // Delete its files

        $course->delete();
        return redirect()->back()->with('message', __('Course deleted successfully'));
    }
}
