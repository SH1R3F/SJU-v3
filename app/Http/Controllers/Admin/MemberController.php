<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Branch;
use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Exports\MembersExport;
use App\Services\MemberService;
use App\Events\MemberRegistered;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\MembershipPaid;
use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Storage;
use App\Notifications\MembershipRefused;
use App\Notifications\MembershipAccepted;
use App\Http\Requests\NotifyMembersRequest;
use App\Notifications\MembershipUnaccepted;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PushNotificationToUsers;
use App\Http\Requests\Member\ProfileExperiencesRequest;

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
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'branch', 'year', 'order', 'dir'])
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
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'branch', 'year', 'order', 'dir']),
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
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'year', 'order', 'dir']),
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
            'filters'  => request()->only(['perPage', 'name', 'national_id', 'membership_number', 'mobile', 'type', 'year', 'order', 'dir']),
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
            default: // Accepted
                $this->authorize('viewAny', Member::class);
                $status = [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED];
                break;
        }
        return Excel::download(new MembersExport($service->getMembers(request(), $status, true)), 'Members.xlsx');
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
        return inertia('Admin/Members/Edit/Index', [
            'member' => new MemberResource($member->load('subscription')),
            'nationalities' => config('sju.nationalities'),
            'branches' => Branch::orderBy('id')->get(['id', 'name']),
        ]);
    }

    /**
     * Show the form for editing experiences of the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function experiences(Member $member)
    {
        $this->authorize('update', $member);
        return inertia('Admin/Members/Edit/Experiences', [
            'member' => new MemberResource($member)
        ]);
    }

    /**
     * Show the form for editing documents of the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function documents(Member $member)
    {
        $this->authorize('update', $member);
        return inertia('Admin/Members/Edit/Documents', [
            'member' => new MemberResource($member->load('subscription')),
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

        // Create subscription
        if ($data['type']) $member->subscription()->update(['type' => $data['type']]);

        // Response
        return redirect()->route('admin.members.index')->with('message', __('Member updated successfully'));
    }

    /**
     * Update the experiences of the specified resource in storage.
     *
     * @param  \App\Http\Requests\Member\ProfileExperiencesRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function updateExperiences(ProfileExperiencesRequest $request, Member $member)
    {
        $this->authorize('update', $member);

        // Update member
        $member->update($request->validated());

        // Response
        return redirect()->back()->with('message', __('Member updated successfully'));
    }

    /**
     * Update the documents of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function updateDocuments(Request $request, Member $member)
    {
        $this->authorize('update', $member);

        $data = $request->validate([
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'national_id_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'statement_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'contract_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'license_photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) $data['profile_photo'] = $request->file('profile_photo')->store("members/{$member->national_id}");
        if ($request->hasFile('national_id_photo')) $data['national_id_photo'] = $request->file('national_id_photo')->store("members/{$member->national_id}");
        if ($request->hasFile('statement_photo')) $data['statement_photo'] = $request->file('statement_photo')->store("members/{$member->national_id}");
        if ($request->hasFile('contract_photo')) $data['contract_photo'] = $request->file('contract_photo')->store("members/{$member->national_id}");
        if ($request->hasFile('license_photo')) $data['license_photo'] = $request->file('license_photo')->store("members/{$member->national_id}");

        // Update member
        $member->update($data);

        // Response
        return redirect()->back()->with('message', __('Member updated successfully'));
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

        $member->notify(new MembershipAccepted);

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

        $member->notify(new MembershipUnaccepted);

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
     * Refuse member.
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
        // $member->subscription()->update(['status' => Subscription::SUBSCRIPTION_INACTIVE]);

        $member->notify(new MembershipRefused);

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
     * Set member as paid.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Services\MemberService  $service
     * @return \Illuminate\Http\Response
     */
    public function setPaid(Member $member, MemberService $service)
    {
        $this->authorize('pay', $member);

        // Update member's subscription
        $member->subscription()->update([
            'start_date' => Carbon::today(),
            'end_date' => Carbon::now()->endOfYear(),
            'status' => Subscription::SUBSCRIPTION_ACTIVE
        ]);
        $member->notify(new MembershipPaid);

        // Create him an invoice
        $price = config('sju.memberships')[$member->subscription->type]['price'] + ($member->delivery_option == 2 ? config('sju.memberships.delivery_fees') : 0);
        (new InvoiceService)->create($member, [
            'amount' => $price,
            'method' => 'manual',
            'set_by' => Auth::guard('admin')->user()->id
        ]);

        // Give membershipt number!
        $service->membershipNumber($member);

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
        return inertia('Admin/Members/Notifications/Create');
    }

    /**
     * list the members by chuncks for the select options.
     *
     * @return \Illuminate\Http\Response
     */
    public function chuncks()
    {
        $this->authorize('notify', Member::class);
        $members = Member::when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->filter(request())
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text")),
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"))
            )
            ->orderBy('id')
            ->paginate(20);

        return $members;
    }

    /**
     * Send the notification to specified users.
     *
     * @param  \App\Http\Requests\NotifyMembersRequest  $request
     * @param  \App\Services\MemberService  $service
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
