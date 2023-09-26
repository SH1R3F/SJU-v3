<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Exports\VolunteersExport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Events\VolunteerRegistered;
use App\Http\Controllers\Controller;
use App\Services\CertificateService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreVolunteer;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\VolunteerResource;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\NotifyVolunteersRequest;
use App\Notifications\PushNotificationToUsers;

class VolunteerController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Volunteer::class, 'volunteer');
    }

    /**
     * Display a listing of the resource.
     */
    public function index($status = 'active')
    {
        $volunteers = Volunteer::withCount('courses')
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->when($status == 'active', fn ($query) => $query->where('status', 1))
            ->when($status == 'inactive', fn ($query) => $query->where('status', '!=', 1))
            ->addSelect([
                'branch_name' => Branch::select('name')->whereColumn('branches.id', 'volunteers.branch_id')->take(1),
            ])
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Volunteers/Index', [
            'volunteers' => VolunteerResource::collection($volunteers)->additional([
                'can_export' => request()->user()->can('export', Volunteer::class),
                'can_create' => request()->user()->can('create', Volunteer::class),
                'can_notify' => request()->user()->can('viewAny', Volunteer::class),
            ]),
            'status' => $status,
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
            'filters' => request()->only(['perPage', 'name', 'national_id', 'mobile', 'branch', 'field', 'order', 'dir'])
        ]);
    }

    /**
     * Export a listing of the resource.
     *
     * @param string  $status
     * @return \Illuminate\Http\Response
     */
    public function export($status = 'active')
    {
        $this->authorize('export', Volunteer::class);

        $volunteers = Volunteer::withCount('courses')
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->when($status == 'active', fn ($query) => $query->where('status', 1))
            ->when($status == 'inactive', fn ($query) => $query->where('status', '!=', 1))
            ->filter(request())
            ->order(request())
            ->get();

        return Excel::download(new VolunteersExport($volunteers), 'Volunteers.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = config('sju.countries', []);
        $cities = config('sju.cities', []);
        $nationalities = config('sju.nationalities_ar', []);
        $qualifications = config('sju.qualifications', []);
        $branches = Branch::orderBy('id')->get(['id', 'name']);
        return inertia('Admin/Volunteers/Create', compact('countries', 'cities', 'nationalities', 'qualifications', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVolunteer  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVolunteer $request)
    {
        $data = $request->validated();
        $data['city'] = $data['city'] ?? 0;
        $data['password'] = bcrypt($data['password'] ?? '123456');
        $data['status'] = 1;

        // Save image
        // if ($data['profile_photo'] instanceof UploadedFile) {
        //     $data['profile_photo'] = $data['profile_photo']->store("volunteers/photos");
        // }

        // Create
        $volunteer = Volunteer::create($data);

        // Fire event
        event(new VolunteerRegistered($volunteer));

        return redirect()->route('admin.volunteers.index')->with('message', __('Volunteer created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        $volunteer = new VolunteerResource($volunteer->load('courses', 'branch'));
        return inertia('Admin/Volunteers/View', compact('volunteer'));
    }

    /**
     * Get the certificate for an attended course.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @param  \App\Models\Course\Course  $course
     * @param  \App\Services\CertificateService  $service
     * @return \Illuminate\Http\Response
     */
    public function certificate(Volunteer $volunteer, Course $course, CertificateService $service)
    {
        $this->authorize('view', $volunteer);

        if (!$volunteer->courses()->where('course_id', $course->id)->count()) return redirect()->back()->with('message', __("Volunteer didn't register this course"));
        if (!$volunteer->courses()->where('course_id', $course->id)->first()->pivot?->attendance) return redirect()->back()->with('message', __("Volunteer didn't attend this course"));

        // Does this course have a template?
        if (!$course->template) return redirect()->back()->with('message', __("This course doesn't have a certificate"));

        // Generate certificate for this user.
        $service->create($volunteer, $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        $countries = config('sju.countries', []);
        $cities = config('sju.cities', []);
        $nationalities = config('sju.nationalities_ar', []);
        $qualifications = config('sju.qualifications', []);
        $branches = Branch::orderBy('id')->get(['id', 'name']);
        $volunteer = new VolunteerResource($volunteer);
        return inertia('Admin/Volunteers/Edit', compact('countries', 'cities', 'nationalities', 'qualifications', 'branches', 'volunteer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreVolunteer  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVolunteer $request, Volunteer $volunteer)
    {
        $data = $request->validated();
        $data['city'] = $data['city'] ?? 0;
        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        // Save image
        // if ($data['profile_photo'] instanceof UploadedFile) {
        //     $data['profile_photo'] = $data['profile_photo']->store("volunteers/photos");
        // }

        // Create
        $volunteer->update($data);

        return redirect()->route('admin.volunteers.index')->with('message', __('Volunteer updated successfully'));
    }

    /**
     * Toggle active status for a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request, Volunteer $volunteer)
    {
        $this->authorize('update', $volunteer);
        $data = ['status' => $state = $volunteer->status == 1 ? 0 : 1];
        if ($state) {
            $data['email_verified_at'] = now();
        }
        $volunteer->update($data);
        return redirect()->back()->with('message', __($state ? 'Volunteer enabled successfully' : 'Volunteer disabled successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        Storage::delete($volunteer->profile_photo);
        $volunteer->delete();
        return redirect()->back()->with('message', __('Volunteer deleted successfully'));
    }

    /**
     * Show the form to send a notification to volunteers.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNotifyForm()
    {
        $this->authorize('viewAny', Volunteer::class);

        return inertia('Admin/Volunteers/Notifications/Create');
    }

    /**
     * list the volunteers by chuncks for the select options.
     *
     * @return \Illuminate\Http\Response
     */
    public function chuncks()
    {
        $this->authorize('viewAny', Volunteer::class);
        $volunteers = Volunteer::filter(request())
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text")),
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"))
            )
            ->orderBy('id')
            ->paginate(20);

        return $volunteers;
    }

    /**
     * Send the notification to specified users.
     *
     * @param  \App\Http\Requests\NotifyVolunteersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function notify(NotifyVolunteersRequest $request)
    {
        $this->authorize('viewAny', Volunteer::class);

        switch ($request['to_type']) {
            case 'select':
                $recipients = Volunteer::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->whereIn('id', $request['recipients'])
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'all':
                $recipients = Volunteer::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'active':
                $recipients = Volunteer::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->where('status', 1)
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'inactive':
                $recipients = Volunteer::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->where('status', '!=', 1)
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
        }

        Notification::send($recipients, new PushNotificationToUsers($request->validated()));

        return redirect()->route('admin.volunteers.index')->with('message', __('Notification is being sent'));
    }
}
