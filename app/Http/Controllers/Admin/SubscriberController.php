<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Exports\SubscribersExport;
use Illuminate\Support\Facades\DB;
use App\Events\SubscriberRegistered;
use App\Http\Controllers\Controller;
use App\Services\CertificateService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreSubscriber;
use App\Http\Resources\SubscriberResource;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PushNotificationToUsers;
use App\Http\Requests\NotifySubscribersRequest;

class SubscriberController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Subscriber::class, 'subscriber');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = 'active')
    {
        $subscribers = Subscriber::withCount('courses')
            ->when($status == 'active', fn ($query) => $query->where('status', 1))
            ->when($status == 'inactive', fn ($query) => $query->where('status', '!=', 1))
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Subscribers/Index', [
            'subscribers' => SubscriberResource::collection($subscribers)->additional([
                'can_export' => request()->user()->can('export', Subscriber::class),
                'can_create' => request()->user()->can('create', Subscriber::class),
                'can_notify' => request()->user()->can('viewAny', Subscriber::class),
            ]),
            'status' => $status,
            'filters' => request()->only(['perPage', 'name', 'mobile', 'order', 'dir'])
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
        $this->authorize('export', Subscriber::class);

        $subscribers = Subscriber::withCount('courses')
            ->when($status == 'active', fn ($query) => $query->where('status', 1))
            ->when($status == 'inactive', fn ($query) => $query->where('status', '!=', 1))
            ->filter(request())
            ->order(request())
            ->get();

        return Excel::download(new SubscribersExport($subscribers), 'Subscribers.xlsx');
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
        return inertia('Admin/Subscribers/Create', compact('countries', 'cities', 'nationalities', 'qualifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriber  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriber $request)
    {
        $data = $request->validated();
        $data['city'] = $data['city'] ?? 0;
        $data['password'] = bcrypt($data['password'] ?? '123456');
        $data['status'] = 1;

        // Create
        $subscriber = Subscriber::create($data);

        // Fire event
        event(new SubscriberRegistered($subscriber));

        return redirect()->route('admin.subscribers.index')->with('message', __('Subscriber created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        $subscriber = new SubscriberResource($subscriber->load('courses'));
        return inertia('Admin/Subscribers/View', compact('subscriber'));
    }

    /**
     * Get the certificate for an attended course.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @param  \App\Models\Course\Course  $course
     * @param  \App\Services\CertificateService  $service
     * @return \Illuminate\Http\Response
     */
    public function certificate(Subscriber $subscriber, Course $course, CertificateService $service)
    {
        $this->authorize('view', $subscriber);


        if (!$subscriber->courses()->where('course_id', $course->id)->count()) return redirect()->back()->with('message', __("Subscriber didn't register this course"));
        if (!$subscriber->courses()->where('course_id', $course->id)->first()->pivot?->attendance) return redirect()->back()->with('message', __("Subscriber didn't attend this course"));

        // Does this course have a template?
        if (!$course->template) return redirect()->back()->with('message', __("This course doesn't have a certificate"));

        // Generate certificate for this user.
        $service->create($subscriber, $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        $countries = config('sju.countries', []);
        $cities = config('sju.cities', []);
        $nationalities = config('sju.nationalities_ar', []);
        $qualifications = config('sju.qualifications', []);
        $subscriber = new SubscriberResource($subscriber);
        return inertia('Admin/Subscribers/Edit', compact('countries', 'cities', 'nationalities', 'qualifications', 'subscriber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriber  $request
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubscriber $request, Subscriber $subscriber)
    {
        $data = $request->validated();
        $data['city'] = $data['city'] ?? 0;
        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        // Update
        $subscriber->update($data);

        return redirect()->route('admin.subscribers.index')->with('message', __('Subscriber updated successfully'));
    }

    /**
     * Toggle active status for a resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request, Subscriber $subscriber)
    {
        $this->authorize('update', $subscriber);
        $data = ['status' => $state = $subscriber->status == 1 ? 0 : 1];
        if ($state) {
            $data['email_verified_at'] = now();
        }
        $subscriber->update($data);
        return redirect()->back()->with('message', __($state ? 'Subscriber enabled successfully' : 'Subscriber disabled successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->back()->with('message', __('Subscriber deleted successfully'));
    }

    /**
     * Show the form to send a notification to subscribers.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNotifyForm()
    {
        $this->authorize('viewAny', Subscriber::class);

        return inertia('Admin/Subscribers/Notifications/Create');
    }

    /**
     * list the subscribers by chuncks for the select options.
     *
     * @return \Illuminate\Http\Response
     */
    public function chuncks()
    {
        $this->authorize('viewAny', Subscriber::class);

        $subscribers = Subscriber::filter(request())
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text")),
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"))
            )
            ->orderBy('id')
            ->paginate(20);

        return $subscribers;
    }

    /**
     * Send the notification to specified users.
     *
     * @param  \App\Http\Requests\NotifySubscribersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function notify(NotifySubscribersRequest $request)
    {
        $this->authorize('viewAny', Subscriber::class);

        switch ($request['to_type']) {
            case 'select':
                $recipients = Subscriber::whereIn('id', $request['recipients'])
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'all':
                $recipients = Subscriber::all();
                // $recipients = Subscriber::whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")->get();
                break;
            case 'active':
                $recipients = Subscriber::where('status', 1)
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'inactive':
                $recipients = Subscriber::where('status', '!=', 1)
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
        }

        Notification::send($recipients, new PushNotificationToUsers($request->validated()));

        return redirect()->route('admin.subscribers.index')->with('message', __('Notification is being sent'));
    }
}
