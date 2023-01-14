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
     * @param array  $status
     */
    public function getMembers(Request $request, array $statuses)
    {
        return Member::with('subscription', 'branch')
            ->whereIn('status', $statuses)
            ->when(Auth::user()->hasRole('Branch manager'), fn ($query) => $query->where('branch_id', $request->user()->branch_id))
            ->filter($request)
            ->orderBy('updated_at', 'DESC') // Might be dynamic too?
            ->paginate($request->perPage ?: 10)
            ->withQueryString();
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
            'fulltime'  => Member::with('subscription')->whereIn('status', $statuses)->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
            'parttime'  => Member::with('subscription')->whereIn('status', $statuses)->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
            'affiliate' => Member::with('subscription')->whereIn('status', $statuses)->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
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
}
