<?php

namespace App\Http\Controllers\Admin\Course;

use App\Models\Branch;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Subscriber;
use App\Models\Course\Type;
use App\Models\Course\Place;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Gender;
use App\Exports\CoursesExport;
use App\Models\Course\Category;
use App\Models\Course\Question;
use App\Models\Course\Template;
use App\Services\CourseService;
use App\Exports\CoursablesExport;
use Illuminate\Support\Facades\DB;
use App\Exports\QuestionnaireExport;
use App\Http\Controllers\Controller;
use App\Models\Course\Questionnaire;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\CourseResource;
use App\Http\Requests\Course\CourseRequest;
use App\Http\Requests\NotifyCoursersRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PushNotificationToUsers;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Course::class, 'course');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('course_branch_id', Auth::guard('admin')->user()->branch_id))
            ->filter(request())
            ->addSelect([
                'course_type' => Type::select('name')->whereColumn('courses_types.id', 'courses.course_type_id')->take(1),
                'course_branch' => Branch::select('name')->whereColumn('branches.id', 'courses.course_branch_id')->take(1),
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
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
            'filters' => request()->only(['perPage', 'title', 'course_number', 'year', 'month', 'branch', 'order', 'dir'])
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function export()
    {
        $this->authorize('viewAny', Course::class);

        $courses = Course::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('course_branch_id', Auth::guard('admin')->user()->branch_id))
            ->filter(request())
            ->addSelect([
                'course_type' => Type::select('name')->whereColumn('courses_types.id', 'courses.course_type_id')->take(1),
                'course_branch' => Branch::select('name')->whereColumn('branches.id', 'courses.course_branch_id')->take(1),
                'course_gender' => Gender::select('name')->whereColumn('courses_genders.id', 'courses.course_gender_id')->take(1),
                'course_category' => Category::select('name')->whereColumn('courses_categories.id', 'courses.course_category_id')->take(1),
            ])
            ->order(request())
            ->get();

        return Excel::download(new CoursesExport($courses), 'Courses.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return inertia('Admin/Courses/Create', [
            'types' => Type::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'genders' => Gender::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'categories' => Category::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->select('id', 'name')->get(),
            'templates' => Template::orderBy('id', 'DESC')->select('id', 'name')->get(),
            'questionnaires' => Questionnaire::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name_ar')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request, CourseService $service)
    {
        $course = $service->create($request->validated());
        return redirect()->route('admin.courses.index')->with('message', __('Course created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $course = Course::with('members', 'subscribers', 'volunteers')
            ->addSelect([
                'course_type' => Type::select('name')->whereColumn('courses_types.id', 'courses.course_type_id')->take(1),
                'course_branch' => Branch::select('name')->whereColumn('branches.id', 'courses.course_branch_id')->take(1),
                'course_gender' => Gender::select('name')->whereColumn('courses_genders.id', 'courses.course_gender_id')->take(1),
                'course_category' => Category::select('name')->whereColumn('courses_categories.id', 'courses.course_category_id')->take(1),
            ])
            ->find($course->id);

        return inertia('Admin/Courses/View', [
            'course' => new CourseResource($course),
        ]);
    }

    /**
     * Export users of a specific course.
     */
    public function exportCoursables(Course $course)
    {
        $this->authorize('view', $course);

        $course = Course::with('members', 'subscribers', 'volunteers')
            ->find($course->id);


        return Excel::download(new CoursablesExport($course), 'Course.xlsx');
    }

    /**
     * Send a notification for all kind of users in this course.
     */
    public function showNotificationForm(Course $course)
    {
        $this->authorize('view', $course);

        return inertia('Admin/Courses/Notify', [
            'course' => new CourseResource($course),
        ]);
    }

    /**
     * chuncking users for notification form's dropdown.
     */
    public function chuncks(Course $course)
    {
        $this->authorize('view', $course);

        $subscribers = $course->subscribers()->filter(request())
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select(DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text"), DB::raw("CONCAT('subscriber-', subscribers.id) AS type_id")),
                fn ($q) => $q->select(DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"), DB::raw("CONCAT('subscriber-', subscribers.id) AS type_id"))
            )
            ->orderBy('id')
            ->paginate(10);
        $members = $course->members()->filter(request())
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select(DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text"), DB::raw("CONCAT('member-', members.id) AS type_id")),
                fn ($q) => $q->select(DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"), DB::raw("CONCAT('member-', members.id) AS type_id"))
            )
            ->orderBy('id')
            ->paginate(10);

        $volunteers = $course->volunteers()->filter(request())
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select('volunteers.id', DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text"), DB::raw("CONCAT('volunteer-', volunteers.id) AS type_id")),
                fn ($q) => $q->select('volunteers.id', DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"), DB::raw("CONCAT('volunteer-', volunteers.id) AS type_id"))
            )
            ->orderBy('id')
            ->paginate(10);

        return [
            'subscribers' => $subscribers,
            'members'     => $members,
            'volunteers'  => $volunteers,
        ];
    }

    /**
     * Send a notification for all kind of users in this course.
     */
    public function notify(NotifyCoursersRequest $request, Course $course)
    {
        $this->authorize('view', $course);
        switch ($request['to_type']) {
            case 'select':
                $subs = [];
                $vols = [];
                $mems = [];
                array_map(function ($val) use (&$subs, &$vols, &$mems) {
                    if (str_contains($val, 'subscriber-')) array_push($subs, explode('-', $val)[1]);
                    if (str_contains($val, 'member-')) array_push($mems, explode('-', $val)[1]);
                    if (str_contains($val, 'volunteer-')) array_push($vols, explode('-', $val)[1]);
                }, $request['recipients']);

                $recipients = Subscriber::whereIn('id', $subs)
                    ->get()
                    ->merge(Member::whereIn('id', $mems)->get())
                    ->merge(Volunteer::whereIn('id', $vols)->get());
                break;
            case 'all':
                $recipients = $course->subscribers->merge($course->members)->merge($course->volunteers);
                break;
            case 'passed':
                $recipients = $course->subscribers()->wherePivot('attendance', 1)->get()->merge($course->members()->wherePivot('attendance', 1)->get())->merge($course->volunteers()->wherePivot('attendance', 1)->get());
                break;
            case 'unpassed':
                $recipients = $course->subscribers()->wherePivot('attendance', 0)->get()->merge($course->members()->wherePivot('attendance', 0)->get())->merge($course->volunteers()->wherePivot('attendance', 0)->get());
                break;
        }

        Notification::send($recipients, new PushNotificationToUsers($request->validated()));

        return redirect()->route('admin.courses.show', $course->id)->with('message', __('Notification is being sent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return inertia('Admin/Courses/Edit', [
            'course' => new CourseResource($course),
            'types' => Type::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'genders' => Gender::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'categories' => Category::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->select('id', 'name')->get(),
            'templates' => Template::orderBy('id', 'DESC')->select('id', 'name')->get(),
            'questionnaires' => Questionnaire::where('status', 1)->orderBy('id', 'DESC')->select('id', 'name_ar')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course, CourseService $service)
    {
        $service->update($request->validated(), $course);

        return redirect()->route('admin.courses.index')->with('message', __('Course updated successfully'));
    }

    /**
     * Toggle active status for a resource.
     */
    public function toggle(Course $course)
    {
        $this->authorize('toggle', $course);
        $course->update(['status' => $state = $course->status == 2 ? 1 : 2]);
        return redirect()->back()->with('message', __($state == 2 ? 'Course hidden successfully' : 'Course enabled successfully'));
    }

    /**
     * Toggle attendance status for a resource.
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
     */
    public function destroy(Course $course)
    {
        // Delete its files

        $course->delete();
        return redirect()->back()->with('message', __('Course deleted successfully'));
    }

    /**
     * Display the results of the questionnaire.
     */
    public function results(Course $course, CourseService $service)
    {
        $questionnaire = Questionnaire::findOrFail($course->questionnaire_id);

        $this->authorize('view', $questionnaire);

        $data = $service->questionnaireResults($course, $questionnaire);

        return inertia('Admin/Courses/Results', $data);
    }

    /**
     * export the results of the questionnaire.
     */
    public function exportQuestionnaire(Course $course, CourseService $service)
    {
        $questionnaire = Questionnaire::findOrFail($course->questionnaire_id);

        $this->authorize('view', $questionnaire);

        $data = $service->export($course, $questionnaire);

        return Excel::download(new QuestionnaireExport($data), 'Questionnaire.xlsx');
    }
}
