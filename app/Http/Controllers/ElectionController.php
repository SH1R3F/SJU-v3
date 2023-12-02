<?php

namespace App\Http\Controllers;

use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class ElectionController extends Controller
{
    /**
     * Subscribe to elections
     */
    public function subscribed()
    {
        abort_if(!Auth::user()->activeMember() || Auth::user()->subscription?->type !== 1, 404);

        Election::updateOrCreate(['member_id' => Auth::user()->id]);

        return inertia('Members/Elections/Subscribed');
    }

    /**
     * List election candidates
     */
    public function candidates()
    {
        $member = Auth::user();
        abort_if(!$member->activeMember() || $member->subscription?->type !== 1, 404);
        abort_if(!Election::where('member_id', $member->id)->first(), 404);

        $candidates = Candidate::with('candidate', 'candidate.branch')->paginate(20);
        return inertia('Members/Elections/Candidates', [
            'candidates' => CandidateResource::collection($candidates),
            'vote' => $member->vote?->candidate_id
        ]);
    }


    /**
     * Store member's vote to a candidate
     */
    public function vote(Candidate $candidate)
    {
        $member = Auth::user();
        abort_if(!$member->activeMember() || $member->subscription?->type !== 1, 404);
        abort_if(!Election::where('member_id', $member->id)->first(), 404);

        if (!$member->vote) {
            $member->vote()->create(['candidate_id' => $candidate->id]);
        }

        return redirect()->back()->with(['message' => __('Your vote has been registered successfully')]);
    }

}
