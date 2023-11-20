<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MemberResource;
use Mccarlosen\LaravelMpdf\LaravelMpdf;

class MemberService
{

    /**
     * Fetch members depending on status
     *
     * @param \Illuminate\Http\Request  $request
     * @param array  $statuses
     * @param boolean  $export
     */
    public function getMembers(Request $request, array $statuses, $export = false)
    {
        return Member::with('subscription', 'branch')
            ->whereIn('status', $statuses)
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->filter($request)
            ->order($request)
            ->when($export, fn ($query) => $query->get(), fn ($query) => $query->paginate($request->perPage ?: 10)->withQueryString());
    }

    /**
     * Fetch members resource on status
     *
     * @param \Illuminate\Http\Request  $request
     * @param array  $status
     */
    public function getMembersResource(Request $request, array $statuses)
    {
        $members = $this->getMembers($request, $statuses);

        return MemberResource::collection($members)->additional([
            'fulltime'  => Member::whereIn('status', $statuses)->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
            'parttime'  => Member::whereIn('status', $statuses)->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
            'affiliate' => Member::whereIn('status', $statuses)->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
            'can_create' => request()->user()->can('create', Member::class),
            'can_export' => request()->user()->can('export', Member::class),
            'can_notify' => request()->user()->can('notify', Member::class),
        ]);
    }

    /**
     * Generate membership number for new subscribers
     *
     * @param \App\Models\Member  $member
     * @return void
     */
    public function membershipNumber(Member $member)
    {
        $append = $member->subscription->type;

        // Get last member number
        $last = Member::where('membership_number', 'LIKE', "$append-%")->orderBy('membership_number', 'DESC')->first();

        // Number to start from.
        $num = $last ? explode('-', $last->membership_number)[1] : (($append == 2) ? 20 : 10);

        $membership_number = "$append-" . str_pad(intval($num) + 1, 4, '0', STR_PAD_LEFT);
        $member->update(['membership_number' => $membership_number]);
    }


    /**
     * Prepare the recipients of a single notification
     */
    public function prepareRecipients(array $data)
    {
        switch ($data['to_type']) {
            case 'select':
                return Member::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->whereIn('id', $data['recipients'])
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'all':
                return Member::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->when($data['branch'] !== 'all', fn($query) => $query->where('branch_id', $data['branch']))
                    ->when($data['status'] !== 'all', fn ($query) => $query->where('status', $this->getRecipientsStatus($data['status'])))
                    ->where('status', '!=', Member::STATUS_DISABLED)
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'fulltime':
                return Member::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->when($data['branch'] !== 'all', fn($query) => $query->where('branch_id', $data['branch']))
                    ->when($data['status'] !== 'all', fn ($query) => $query->where('status', $this->getRecipientsStatus($data['status'])))
                    ->where('status', '!=', Member::STATUS_DISABLED)
                    ->whereHas('subscription', fn ($query) => $query->where('type', 1))
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'parttime':
                return Member::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->when($data['branch'] !== 'all', fn($query) => $query->where('branch_id', $data['branch']))
                    ->when($data['status'] !== 'all', fn ($query) => $query->where('status', $this->getRecipientsStatus($data['status'])))
                    ->where('status', '!=', Member::STATUS_DISABLED)
                    ->whereHas('subscription', fn ($query) => $query->where('type', 2))
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
            case 'affiliate':
                return Member::when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
                    ->when($data['branch'] !== 'all', fn($query) => $query->where('branch_id', $data['branch']))
                    ->when($data['status'] !== 'all', fn ($query) => $query->where('status', $this->getRecipientsStatus($data['status'])))
                    ->where('status', '!=', Member::STATUS_DISABLED)
                    ->whereHas('subscription', fn ($query) => $query->where('type', 3))
                    // ->whereRaw("email REGEXP '^[^@]+@[^@]+\.[^@]{2,}$'")
                    ->get();
                break;
        }
    }

    /**
     * Export members to PDF
     */
    public function exportPdf($status)
    {
        $members = Member::with('subscription', 'branch')
            ->whereIn('status', $status)
            ->when(Auth::user()->hasRole('Branch manager') || \App\Models\Employee::find(Auth::user()->id)?->hasRole('Employee'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
            ->filter(request())
            ->order(request());

        $fulltime = $members->clone()->whereHas('subscription', fn ($query) => $query->where('type', 1))->get();
        $parttime = $members->clone()->whereHas('subscription', fn ($query) => $query->where('type', 2))->get();
        $affiliate = $members->clone()->whereHas('subscription', fn ($query) => $query->where('type', 3))->get();

        $pdf = (new LaravelMpdf)->getMpdf();

        $counter = 1;
        foreach ($fulltime->chunk(20) as $k => $chunk) {
            $chunk->map(function ($member) use (&$counter) {
                $member->counter = $counter++;
                return $member;
            });
            $pdf->WriteHTML(view('pdf.members', ['members' => $chunk, 'type' => 'متفرغ']));
            if ($k + 1 != count($fulltime->chunk(20))) $pdf->AddPage();
        }
        foreach ($parttime->chunk(20) as $k => $chunk) {
            $chunk->map(function ($member) use (&$counter) {
                $member->counter = $counter++;
                return $member;
            });

            if ($k == 0) $pdf->AddPage();
            $pdf->WriteHTML(view('pdf.members', ['members' => $chunk, 'type' => 'غير متفرغ']));
            if ($k + 1 != count($parttime->chunk(20))) $pdf->AddPage();
        }
        foreach ($affiliate->chunk(20) as $k => $chunk) {
            $chunk->map(function ($member) use (&$counter) {
                $member->counter = $counter++;
                return $member;
            });

            if ($k == 0) $pdf->AddPage();
            $pdf->WriteHTML(view('pdf.members', ['members' => $chunk, 'type' => 'منتسب']));
            if ($k + 1 != count($affiliate->chunk(20))) $pdf->AddPage();
        }

        return $pdf->Output();
    }

    /**
     * Export members stats to PDF
     */
    public function statsPdf()
    {
        $pdf = (new LaravelMpdf)->getMpdf();

        $fulltime   = Member::where('status', 2)->whereHas('subscription', fn($q) => $q->where('type', 1)->where('status', 1)->where('end_date', '>', Carbon::today()))->count();
        $ft_waiting = Member::where('status', 2)->whereHas('subscription', fn($q) => $q->where('type', 1)->where('status', '!=', 1))->count();
        $parttime   = Member::where('status', 2)->whereHas('subscription', fn($q) => $q->where('type', 2)->where('status', 1)->where('end_date', '>', Carbon::today()))->count();
        $pt_waiting = Member::where('status', 2)->whereHas('subscription', fn($q) => $q->where('type', 2)->where('status', '!=', 1))->count();
        $affiliate   = Member::where('status', 2)->whereHas('subscription', fn($q) => $q->where('type', 3)->where('status', 1)->where('end_date', '>', Carbon::today()))->count();
        $af_waiting  = Member::where('status', 2)->whereHas('subscription', fn($q) => $q->where('type', 3)->where('status', '!=', 1))->count();


        $branch_waitlist_fulltime   = Member::where('status', 0)->whereHas('subscription', fn($q) => $q->where('type', 1))->count();
        $branch_waitlist_parttime   = Member::where('status', 0)->whereHas('subscription', fn($q) => $q->where('type', 2))->count();
        $branch_waitlist_affiliate  = Member::where('status', 0)->whereHas('subscription', fn($q) => $q->where('type', 3))->count();

        $admin_waitlist_fulltime   = Member::where('status', 1)->whereHas('subscription', fn($q) => $q->where('type', 1))->count();
        $admin_waitlist_parttime   = Member::where('status', 1)->whereHas('subscription', fn($q) => $q->where('type', 2))->count();
        $admin_waitlist_affiliate  = Member::where('status', 1)->whereHas('subscription', fn($q) => $q->where('type', 3))->count();


        $pdf->WriteHTML(view('pdf.members-stats', compact(
            'fulltime',
            'ft_waiting',
            'parttime',
            'pt_waiting',
            'affiliate',
            'af_waiting',

            'branch_waitlist_fulltime',
            'branch_waitlist_parttime',
            'branch_waitlist_affiliate',

            'admin_waitlist_fulltime',
            'admin_waitlist_parttime',
            'admin_waitlist_affiliate',
        )));

        return $pdf->Output();
    }


    /**
     * Get recipients status by status name
     * @param string $status
     * @return int
     */
    private function getRecipientsStatus(string $status)
    {
        return match ($status) {
            'members' => Member::STATUS_ACCEPTED,
            'branch_approval' => Member::STATUS_UNAPPROVED,
            'admin_approval' => Member::STATUS_APPROVED,
            'refused' => Member::STATUS_REFUSED
        };
    }

}
