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
            ->orderBy('id') // Might be dynamic too?
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
            'fulltime'  => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 1))->count(),
            'parttime'  => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 2))->count(),
            'affiliate' => Member::with('subscription')->whereIn('status', [Member::STATUS_ACCEPTED, Member::STATUS_DISABLED])->whereHas('subscription', fn ($builder) => $builder->where('type', 3))->count(),
            'can_create' => request()->user()->can('create', Member::class),
            'can_export' => request()->user()->can('export', Member::class),
            'can_notify' => request()->user()->can('notify', Member::class),
        ]);
    }
}
