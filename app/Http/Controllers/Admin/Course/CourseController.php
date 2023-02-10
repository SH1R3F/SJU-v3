<?php

namespace App\Http\Controllers\Admin\Course;

use App\Models\Course\Type;
use App\Models\Course\Place;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Gender;
use App\Exports\CoursesExport;
use App\Models\Course\Category;
use App\Models\Course\Template;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Models\Course\Questionnaire;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\CourseResource;
use App\Http\Requests\Course\CourseRequest;

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
            ->filter(request())
            ->addSelect([
                'course_type' => Type::select('name')->whereColumn('courses_types.id', 'courses.course_type_id')->take(1),
                'course_place' => Place::select('name')->whereColumn('courses_places.id', 'courses.course_place_id')->take(1),
                'course_gender' => Gender::select('name')->whereColumn('courses_genders.id', 'courses.course_gender_id')->take(1),
                'course_category' => Category::select('name')->whereColumn('courses_categories.id', 'courses.course_category_id')->take(1),
            ])
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Courses/Index', [
            'courses' => CourseResource::collection($courses)
                ->additional([
                    'can_export' => request()->user()->can('viewAny', Course::class),
                    'can_create' => request()->user()->can('create', Course::class),
                ]),
            'filters' => request()->only(['perPage', 'title', 'course_number', 'year', 'month', 'region', 'order', 'dir'])
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $courses = Course::query()
            ->filter(request())
            ->addSelect([
                'course_type' => Type::select('name')->whereColumn('courses_types.id', 'courses.course_type_id')->take(1),
                'course_place' => Place::select('name')->whereColumn('courses_places.id', 'courses.course_place_id')->take(1),
                'course_gender' => Gender::select('name')->whereColumn('courses_genders.id', 'courses.course_gender_id')->take(1),
                'course_category' => Category::select('name')->whereColumn('courses_categories.id', 'courses.course_category_id')->take(1),
            ])
            ->order(request())
            ->get();

        return Excel::download(new CoursesExport($courses), 'Courses.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return inertia('Admin/Courses/Create', [
            'types' => Type::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'genders' => Gender::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'categories' => Category::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'places' => Place::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'templates' => Template::orderBy('id', 'DESC')->select('id', 'name')->get(),
            'questionnaires' => Questionnaire::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name_ar')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Course\CourseRequest  $request
     * @param  \App\Services\CourseService  $service
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request, CourseService $service)
    {
        $course = $service->create($request->validated());
        return redirect()->route('admin.courses.index')->with('message', __('Course created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $course = $course
            ->with('members', 'subscribers')
            ->addSelect([
                'course_type' => Type::select('name')->whereColumn('courses_types.id', 'courses.course_type_id')->take(1),
                'course_place' => Place::select('name')->whereColumn('courses_places.id', 'courses.course_place_id')->take(1),
                'course_gender' => Gender::select('name')->whereColumn('courses_genders.id', 'courses.course_gender_id')->take(1),
                'course_category' => Category::select('name')->whereColumn('courses_categories.id', 'courses.course_category_id')->take(1),
            ])
            ->first();

        return inertia('Admin/Courses/View', [
            'course' => new CourseResource($course),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return inertia('Admin/Courses/Edit', [
            'course' => new CourseResource($course),
            'types' => Type::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'genders' => Gender::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'categories' => Category::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'places' => Place::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'templates' => Template::orderBy('id', 'DESC')->select('id', 'name')->get(),
            'questionnaires' => Questionnaire::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name_ar')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Course\CourseRequest  $request
     * @param  \App\Models\Course\Course  $course
     * @param  \App\Services\CourseService  $service
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course, CourseService $service)
    {
        $service->update($request->validated(), $course);

        return redirect()->route('admin.courses.index')->with('message', __('Course updated successfully'));
    }

    /**
     * Toggle active status for a resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function toggle(Course $course)
    {
        $this->authorize('toggle', $course);

        $course->update(['status' => $state = $course->active == 2 ? 1 : 2]);
        return redirect()->back()->with('message', __($state == 2 ? 'Course hidden successfully' : 'Course enabled successfully'));
    }

    /**
     * Toggle attendance status for a resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleAttendance(Course $course, $type, $id)
    {
        $this->authorize('update', $course);
        $class = [
            'member' => 'App\Models\Member',
            'subscriber' => 'App\Models\Subscriber',
            'volunteer' => 'App\Models\Volunteer',
        ];
        if (!in_array($type, array_keys($class))) return;

        $user = $class[$type]::findOrFail($id);

        $pivot = $user->courses()->where('course_id', $course->id)->first()?->pivot;
        $user->courses()->updateExistingPivot($course->id, ['attendance' => !$pivot?->attendance]);

        return redirect()->back()->with('message', __('Updated successfully'));
    }

    /**
     * Delete attendance for a resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @param  string  $type
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAttendance(Course $course, $type, $id)
    {
        $this->authorize('update', $course);
        $class = [
            'member' => 'App\Models\Member',
            'subscriber' => 'App\Models\Subscriber',
            'volunteer' => 'App\Models\Volunteer',
        ];
        if (!in_array($type, array_keys($class))) return;

        $user = $class[$type]::findOrFail($id);

        $user->courses()->where('course_id', $course->id)->detach();
        return redirect()->back()->with('message', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        // Delete its files

        $course->delete();
        return redirect()->back()->with('message', __('Course deleted successfully'));
    }
}
