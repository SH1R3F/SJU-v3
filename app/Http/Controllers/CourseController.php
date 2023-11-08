<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Question;
use App\Services\CertificateService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionnaireResource;

class CourseController extends Controller
{

    private $auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('member')->check()) {
                $this->auth = Auth::guard('member')->user();
            } else if (Auth::guard('subscriber')->check()) {
                $this->auth = Auth::guard('subscriber')->user();
            } else if (Auth::guard('volunteer')->check()) {
                $this->auth = Auth::guard('volunteer')->user();
            }

            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     */
    public function index($status = 'upcoming')
    {
        $courses = Course::query()
            ->whereIn('status', [1, 2, 3, 4])
            ->when($status == 'upcoming', fn ($query) => $query->whereDate('date_from', '>=', now())->orderBy('date_from', 'ASC'), fn ($query) => $query->whereDate('date_from', '<', now())->orderBy('date_from', 'DESC'))
            ->paginate(request()->perPage ?: 10);

        return inertia('Courses/Index', [
            'courses' => CourseResource::collection($courses)->additional(compact('status'))
        ]);
    }

    /**
     * Display the form of course registration.
     */
    public function showRegisterForm(Course $course)
    {
        $courses = Course::query()
            ->whereNot('id', $course->id)
            ->whereIn('status', [1, 2, 3, 4])
            ->whereDate('date_from', '>=', now())->orderBy('date_from', 'ASC')
            ->take(4)
            ->get();

        $registered = $this->auth?->courses()->where('course_id', $course->id)->count();

        return inertia('Courses/Register', [
            'course' => new CourseResource($course->load('branch', 'category')),
            'courses' => CourseResource::collection($courses),
            'registered' => !!$registered
        ]);
    }

    /**
     * Register user to the course.
     */
    public function register(Request $request, Course $course)
    {
        abort_if(in_array($course->status, [0, 2]), 403);

        $request->validate(['agreement' => 'required|accepted']);

        // Register the user.
        if (!$this->auth->courses()->where('course_id', $course->id)->count()) {
            $this->auth->courses()->attach($course->id);
        }

        return redirect()->back()->with('message', __("You registered successfully"));
    }


    /**
     * Display the form of course attendance.
     */
    public function showAttendForm(Course $course)
    {
        if (!$this->auth?->courses()->where('course_id', $course->id)->count()) return redirect()->route('courses.register', $course->id)->with('message', __('Please register first'));

        $courses = Course::query()
            ->whereNot('id', $course->id)
            ->whereIn('status', [1, 2, 3, 4])
            ->whereDate('date_from', '>=', now())->orderBy('date_from', 'ASC')
            ->take(4)
            ->get();

        $attended = $this->auth?->courses()->where('course_id', $course->id)->first()?->pivot?->attendance;

        return inertia('Courses/Attend', [
            'course' => new CourseResource($course->load('branch', 'category')),
            'courses' => CourseResource::collection($courses),
            'attended' => !!$attended
        ]);
    }

    /**
     * Attend user to the course.
     */
    public function attend(Request $request, Course $course)
    {
        if (!$this->auth->courses()->where('course_id', $course->id)->count()) return redirect()->route('courses.register', $course->id)->with('message', __('Please register first'));

        // Register the user.
        $this->auth->courses()->updateExistingPivot($course->id, ['attendance' => 1]);

        return redirect()->back()->with('message', __("You attended successfully"));
    }

    /**
     * Get the certificate for an attended course.
     */
    public function certificate(Request $request, Course $course, CertificateService $service)
    {
        if (!$this->auth->courses()->where('course_id', $course->id)->count()) return redirect()->route('courses.register', $course->id)->with('message', __('Please register first'));
        if (!$this->auth->courses()->where('course_id', $course->id)->first()->pivot?->attendance) return redirect()->route('courses.attend', $course->id)->with('message', __("Didn't attend course"));

        // Does this course have a questionnaire that I didn't pass?
        if ($course->questionnaire && !$this->auth->questionnaires()->where('questionnaire_id', $course->questionnaire->id)->count()) {
            return redirect()->route('courses.questionnaire', $course->id)->with('message', __("Please fill this questionnaire first"));
        }

        // Does this course have a template?
        if (!$course->template) return redirect()->route('courses.index')->with('error', __("This course doesn't have a certificate"));
        // Generate certificate for this user.
        $service->create($this->auth, $course);
    }

    /**
     * Get the questionnaire for the course.
     */
    public function questionnaire(Request $request, Course $course)
    {
        if (!$this->auth->courses()->where('course_id', $course->id)->count()) return redirect()->route('courses.register', $course->id)->with('message', __('Please register first'));
        if (!$this->auth->courses()->where('course_id', $course->id)->first()->pivot?->attendance) return redirect()->route('courses.attend', $course->id)->with('message', __("Didn't attend course"));
        if (!$course->questionnaire) return;

        if (!$this->auth->questionnaires()->where('questionnaire_id', $course->questionnaire->id)->count()) {
            // What question should we show?
            $answers = Session::get("answers_{$course->questionnaire->id}", []);

            $questions = $course->questionnaire->questions()->orderBy('order')->orderBy('id', 'DESC')->get();
            foreach ($questions as $question) {
                if (collect($answers)->contains('id', '=', $question->id)) continue;

                return inertia('Courses/Questionnaire', [
                    'questionnaire' => new QuestionnaireResource($course->questionnaire->load('questions')),
                    'question' => new QuestionResource($question)
                ]);
            }

            // Save to db
            $this->auth->questionnaires()->attach($course->questionnaire->id, ['answers' => json_encode($answers), 'course_id' => $course->id]);
        }

        return Inertia::location(route('courses.certificate', $course->id));
    }

    /**
     * Submit questionnaire question
     */
    public function question(Request $request, Question $question)
    {
        $answers = Session::get("answers_{$question->questionnaire->id}", []);

        // Validate question
        $data = $request->validate([
            'answer' => ['nullable', 'required_without:choice', 'string', 'max:255'],
            'choice' => ['nullable', 'required_without:answer', 'in:1,2,3,4']
        ]);

        $answer = [
            'id' => $question->id,
            'question' => $question->question,
            'answer' => $question->commentable ? $data['answer'] : $data['choice']
        ];

        // Push to answers
        array_push($answers, $answer);
        Session::put("answers_{$question->questionnaire->id}", $answers);

        return redirect()->back()->with('message', __('Answer saved'));
    }
}
