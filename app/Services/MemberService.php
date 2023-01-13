<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
