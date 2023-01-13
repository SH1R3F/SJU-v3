<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\MembersExport;
use App\Services\MemberService;
use App\Events\MemberRegistered;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Member::class, 'member');
    }

    /**
     * Display accepted members.
     *
     * @param \App\Services\MemberService  $service
     * @return \Illuminate\Http\Response
     */
    public function index(MemberService $service)
    {
        $members = $service->getMembers(request(), [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED]);

        return inertia('Admin/Members/Accepted', [
            'members'  => MemberResource::collection($members)->additional([
                'fulltime'  => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
                'parttime'  => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
                'affiliate' => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
                'can_create' => request()->user()->can('create', Member::class),
                'can_export' => request()->user()->can('export', Member::class),
                'can_notify' => request()->user()->can('notify', Member::class),
            ]),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'branch', 'year'])
        ]);
    }

    /**
     * Display approved [needing acceptance] members.
     *
     * @param \App\Services\MemberService  $service
     * @return \Illuminate\Http\Response
     */
    public function acceptance(MemberService $service)
    {
        $this->authorize('viewAcceptance', Member::class);

        $members = $service->getMembers(request(), [Member::STATUS_APPROVED]);

        return inertia('Admin/Members/AdminAcceptance', [
            'members'  => MemberResource::collection($members)->additional([
                'fulltime'  => Member::with('subscription')->where('status', Member::STATUS_APPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
                'parttime'  => Member::with('subscription')->where('status', Member::STATUS_APPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
                'affiliate' => Member::with('subscription')->where('status', Member::STATUS_APPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
                'can_create' => request()->user()->can('create', Member::class),
                'can_export' => request()->user()->can('export', Member::class),
                'can_notify' => request()->user()->can('notify', Member::class),
            ]),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'branch', 'year']),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
        ]);
    }

    /**
     * Display unapproved members.
     *
     * @param \App\Services\MemberService  $service
     * @return \Illuminate\Http\Response
     */
    public function branch(MemberService $service)
    {
        $this->authorize('viewBranch', Member::class);

        $members = $service->getMembers(request(), [Member::STATUS_UNAPPROVED]);

        return inertia('Admin/Members/BranchApproval', [
            'members'  => MemberResource::collection($members)->additional([
                'fulltime'  => Member::with('subscription')->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', request()->user()->branch_id))->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
                'parttime'  => Member::with('subscription')->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', request()->user()->branch_id))->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
                'affiliate' => Member::with('subscription')->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', request()->user()->branch_id))->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
                'can_create' => request()->user()->can('create', Member::class),
                'can_export' => request()->user()->can('export', Member::class),
                'can_notify' => request()->user()->can('notify', Member::class),
            ]),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'year']),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
        ]);
    }

    /**
     * Display refused members.
     *
     * @param \App\Services\MemberService  $service
     * @return \Illuminate\Http\Response
     */
    public function refused(MemberService $service)
    {
        $this->authorize('viewRefused', Member::class);

        $members = $service->getMembers(request(), [Member::STATUS_REFUSED]);

        return inertia('Admin/Members/Refused', [
            'members'  => MemberResource::collection($members)->additional([
                'fulltime'  => Member::with('subscription')->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', request()->user()->branch_id))->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
                'parttime'  => Member::with('subscription')->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', request()->user()->branch_id))->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
                'affiliate' => Member::with('subscription')->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', request()->user()->branch_id))->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
                'can_create' => request()->user()->can('create', Member::class)
            ]),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'year']),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param string  $page
     * @param \App\Services\MemberService  $service
     * @return \Illuminate\Http\Response
     */
    public function export(string $page, MemberService $service)
    {
        $this->authorize('export', Member::class);

        switch ($page) {
            case 'accepted':
                $this->authorize('viewAny', Member::class);
                $status = [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED];
                break;
            case 'admin-acceptance':
                $this->authorize('viewAcceptance', Member::class);
                $status = [Member::STATUS_APPROVED];
                break;
            case 'branch-approval':
                $this->authorize('viewBranch', Member::class);
                $status = [Member::STATUS_UNAPPROVED];
                break;
            case 'refused':
                $this->authorize('viewRefused', Member::class);
                $status = [Member::STATUS_REFUSED];
                break;
        }
        return Excel::download(new MembersExport($service->getMembers(request(), $status)), 'Members.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Members/Create', [
            'nationalities' => config('sju.nationalities'),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        // Create member
        $data = $request->validated();
        $data['password'] = bcrypt('123456');
        $member = Member::create($data);

        // Create subscription
        $member->subscription()->create(['type' => $data['type']]);
        // Fire event
        event(new MemberRegistered($member));

        // Response
        return redirect()->route('admin.members.index')->with('message', __('Member created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return inertia('Admin/Members/View/Index', [
            'member' => new MemberResource($member->load('subscription', 'branch')),
            'nationalities' => config('sju.nationalities', [])
        ]);
    }

    /**
     * Display contact info of the member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function showContact(Member $member)
    {
        $this->authorize('view', $member);

        return inertia('Admin/Members/View/Contact', [
            'member' => new MemberResource($member->load('subscription', 'branch'))
        ]);
    }

    /**
     * Display Experiences & fields of the member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function showExperiences(Member $member)
    {
        $this->authorize('view', $member);

        return inertia('Admin/Members/View/Experiences', [
            'member' => new MemberResource($member->load('subscription', 'branch'))
        ]);
    }

    /**
     * Display Documents of the member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function showDocuments(Member $member)
    {
        $this->authorize('view', $member);

        return inertia('Admin/Members/View/Documents', [
            'member' => new MemberResource($member->load('subscription', 'branch'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return inertia('Admin/Members/Edit', [
            'member' => new MemberResource($member->load('subscription')),
            'nationalities' => config('sju.nationalities'),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        $data = $request->validated();

        // Update member
        $member->update($data);

        // Response
        return redirect()->route('admin.members.index')->with('message', __('Member updated successfully'));
    }

    /**
     * Admin accept member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function accept(Member $member)
    {
        $this->authorize('accept', $member);

        $member->update([
            'status' => Member::STATUS_ACCEPTED
        ]);

        return redirect()->back()->with('message', __('Member updated successfully'));
    }

    /**
     * Admin unaccept member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function unaccept(Member $member)
    {
        $this->authorize('accept', $member);

        $member->update([
            'status' => Member::STATUS_APPROVED
        ]);

        return redirect()->back()->with('message', __('Member updated successfully'));
    }

    /**
     * Branch approve member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function approve(Member $member)
    {
        $this->authorize('approve', $member);

        $member->update([
            'status' => Member::STATUS_APPROVED
        ]);

        return redirect()->back()->with('message', __('Member updated successfully'));
    }

    /**
     * Branch disapprove member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function disapprove(Member $member)
    {
        $this->authorize('disapprove', $member);

        $member->update([
            'status' => Member::STATUS_UNAPPROVED
        ]);

        return redirect()->back()->with('message', __('Member updated successfully'));
    }

    /**
     * Branch refuse member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function refuse(Request $request, Member $member)
    {
        $this->authorize('refuse', $member);

        $request->validate(['reason'  => ['required', 'in:unsatisfy,other'], 'message' => ['required_if:reason,other', 'string', 'max:255']]);
        $member->update([
            'status' => Member::STATUS_REFUSED,
            'refusal_reason' => $request->reason == 'unsatisfy' ? 'unsatisfy' : $request->message,
        ]);

        // Force redirect
        return Inertia::location(redirect()->back()->with('message', __('Member updated successfully'))->getTargetUrl());
    }

    /**
     * Disable / Enable members.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function toggle(Member $member)
    {
        $this->authorize('toggle', $member);

        $member->update([
            'status' => $member->status == Member::STATUS_DISABLED ? Member::STATUS_UNAPPROVED : Member::STATUS_DISABLED
        ]);

        return redirect()->back()->with('message', __('Member updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        // Delete his storage folder
        Storage::deleteDirectory("members/{$member->id}");
        // Delete member
        $member->delete();
        return redirect()->back()->with('message', __('Member deleted successfully'));
    }
}
