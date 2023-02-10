<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MemberResource;

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
            ->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))
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
            'fulltime'  => Member::whereIn('status', $statuses)->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
            'parttime'  => Member::whereIn('status', $statuses)->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
            'affiliate' => Member::whereIn('status', $statuses)->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', Auth::guard('admin')->user()->branch_id))->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
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
                return Member::whereIn('id', $data['recipients'])->get();
                break;
            case 'all':
                return Member::all();
                break;
            case 'fulltime':
                return Member::whereHas('subscription', fn ($query) => $query->where('type', 1))->get();
                break;
            case 'parttime':
                return Member::whereHas('subscription', fn ($query) => $query->where('type', 2))->get();
                break;
            case 'affiliate':
                return Member::whereHas('subscription', fn ($query) => $query->where('type', 3))->get();
                break;
        }
    }
}
