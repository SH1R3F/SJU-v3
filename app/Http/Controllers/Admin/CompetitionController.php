<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompetitionRequest;
use App\Http\Resources\CompetitionResource;
use App\Models\CompetitionField;

class CompetitionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Competition::class, 'competition');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $competitions = Competition::filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Competitions/Index', [
            'competitions' => CompetitionResource::collection($competitions)
                ->additional([
                    'can_create' => request()->user()->can('create', Competition::class),
                ]),
            'filters' => request()->only(['perPage', 'name', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Competitions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetitionRequest $request)
    {
        $data = $request->validated();
        $competition = Competition::create($data);

        foreach ($data['competition_fields'] as $field) {
            $competition->fields()->create($field);
        }

        return redirect()->route('admin.competitions.index')->with('message', __('Competition created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competition $competition)
    {
        return inertia('Admin/Competitions/Edit', ['competition' => new CompetitionResource($competition->load('fields'))]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetitionRequest $request, Competition $competition)
    {
        $data = $request->validated();
        $competition->update($data);

        $ids = [];
        foreach ($data['competition_fields'] as $field) {
            if (isset($field['id']) && !empty($field['id'])) {
                $ids[] = $field['id'];
                CompetitionField::find($field['id'])->update($field);
            } else {
                $record = $competition->fields()->create($field);
                $ids[] = $record->id;
            }
        }

        $deleted = $competition->fields->pluck('id')->diff($ids);
        CompetitionField::whereIn('id', $deleted)->delete();

        return redirect()->route('admin.competitions.index')->with('message', __('Competition updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competition $competition)
    {
        $competition->delete();
        return redirect()->back()->with('message', __('Competition deleted successfully'));
    }
}
