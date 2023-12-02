<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CandidatesExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CandidateController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Candidate::class, 'candidate');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $candidates = Candidate::with('candidate')
            ->withCount('votes')
            ->filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Candidates/Index', [
            'candidates' => CandidateResource::collection($candidates)
                ->additional([
                    'can_export' => request()->user()->can('export', Candidate::class),
                    'can_create' => request()->user()->can('create', Candidate::class),
                ]),
            'filters' => request()->only(['perPage', 'name', 'order', 'dir'])
        ]);
    }


    /**
     * Export a listing of the resource.
     */
    public function export()
    {
        $this->authorize('export', Candidate::class);

        $candidates = Candidate::with('candidate')
            ->withCount('votes')
            ->filter(request())
            ->order(request())
            ->get();

        return Excel::download(new CandidatesExport($candidates), 'Candidates.xlsx');
    }


    /**
     * Load chuncks of listing of the resource.
     */
    public function chuncks()
    {
        $this->authorize('create', Candidate::class);

        $candidates = Member::whereHas('subscription', fn ($builder) => $builder->where('type', 1))
            ->whereNotIn('id', Candidate::pluck('candidate_id'))
            ->filter(request())
            ->when(
                app()->getLocale() == 'ar',
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_ar, ' ', sname_ar, ' ', tname_ar, ' ', lname_ar) AS text")),
                fn ($q) => $q->select('id', DB::raw("CONCAT(fname_en, ' ', sname_en, ' ', tname_en, ' ', lname_en) AS text"))
            )
            ->orderBy('id')
            ->paginate(20);

        return $candidates;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Candidates/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'candidates' => [
                'required', 'array'
            ],
            'candidates.*' => [
                'required', 'numeric', 'exists:members,id', 'unique:candidates,candidate_id'
            ]
        ]);

        foreach ($request->candidates as $candidate) {
            Candidate::create(['candidate_id' => $candidate]);
        }
        return redirect()->route('admin.candidates.index')->with('message', __('Candidate created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->back()->with('message', __('Candidate deleted successfully'));
    }
}
