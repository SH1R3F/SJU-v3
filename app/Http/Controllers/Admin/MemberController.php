<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\MembersExport;
use App\Events\MemberRegistered;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::with('subscription', 'branch')
            // Only Accepted & Disabled members
            ->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])
            ->filter(request())
            ->orderBy('id') // Might be dynamic too?
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Members/Accepted', [
            'members'  => MemberResource::collection($members)->additional([
                'fulltime'  => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
                'parttime'  => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
                'affiliate' => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
                'can_create' => request()->user()->can('create', Member::class)
            ]),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'branch', 'year'])
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function branch()
    {
        $members = Member::with('subscription', 'branch')
            // Only Awaiting branch approval members
            ->where('status', Member::STATUS_UNAPPROVED)
            ->filter(request())
            // ->when(branch manager, show only his branch's members) // To be added
            ->orderBy('id') // Might be dynamic too?
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Members/BranchApproval', [
            'members'  => MemberResource::collection($members)->additional([
                'fulltime'  => Member::with('subscription')->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
                'parttime'  => Member::with('subscription')->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
                'affiliate' => Member::with('subscription')->where('status', Member::STATUS_UNAPPROVED)->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
                'can_create' => request()->user()->can('create', Member::class)
            ]),
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'branch', 'year'])
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $this->authorize('viewAny', Admin::class);

        return Excel::download(new MembersExport, 'Members.xlsx');
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

    // Approve and disapprove.

    /**
     * Branch approve member.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function approve(Member $member)
    {
        $this->authorize('toggle', $member);

        $member->update([
            'status' => Member::STATUS_APPROVED
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
        $this->authorize('toggle', $member);

        $request->validate(['reason'  => ['required', 'in:unsatisfy,other'], 'message' => ['required_if:reason,other', 'string', 'max:255']]);
        $member->update([
            'status' => Member::STATUS_REFUSED,
            'refusal_reason' => $request->reason == 'unsatisfy' ? 'unsatisfy' : $request->message,
        ]);

        // Force redirect
        return Inertia::location(redirect()->back()->with('message', __('Member updated successfully'))->getTargetUrl());
    }

    /**
     * Update the specified resource in storage.
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
