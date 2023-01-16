<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\MembersExport;
use App\Services\MemberService;
use App\Events\MemberRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NotifyMembersRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PushNotificationToUsers;

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
        return inertia('Admin/Members/Accepted', [
            'members'  => $service->getMembersResource(request(), [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED]),
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

        return inertia('Admin/Members/AdminAcceptance', [
            'members'  => $service->getMembersResource(request(), [Member::STATUS_APPROVED]),
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

        return inertia('Admin/Members/BranchApproval', [
            'members'  => $service->getMembersResource(request(), [Member::STATUS_UNAPPROVED]),
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

        return inertia('Admin/Members/Refused', [
            'members'  => $service->getMembersResource(request(), [Member::STATUS_REFUSED]),
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
     * Show the membership card in pdf format.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function card(Member $member)
    {
        $this->authorize('view', $member);

        $pdf = \PDF::loadView('pdf.membership-card', compact('member'), [], [
            'format' => [74, 120]
        ]);

        return $pdf->stream('membership-card.pdf');
    }

    /**
     * Show the membership form in pdf format.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function form(Member $member)
    {
        $this->authorize('view', $member);

        $pdf = \PDF::loadView('pdf.membership-form', compact('member'));

        return $pdf->stream('membership-form.pdf');
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

    /**
     * Show the form to send a notification to admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function showNotifyForm()
    {
        $this->authorize('notify', Member::class);
        $members = Member::orderBy('id')->get(['id', 'fname_ar', 'sname_ar', 'tname_ar', 'lname_ar', 'fname_en', 'sname_en', 'tname_en', 'lname_en']);

        return inertia('Admin/Members/Notifications/Create', [
            'members' => MemberResource::collection($members)
        ]);
    }

    /**
     * Send the notification to specified users.
     *
     * @param  \App\Http\Requests\NotifyMembersRequest  $request
     * @param  \App\Services\AdminService  $service
     * @return \Illuminate\Http\Response
     */
    public function notify(NotifyMembersRequest $request, MemberService $service)
    {
        $this->authorize('notify', Member::class);

        $recipients = $service->prepareRecipients($request->validated());
        Notification::send($recipients, new PushNotificationToUsers($request->validated()));
        return redirect()->route('admin.members.index')->with('message', __('Notification is being sent'));
    }
}
