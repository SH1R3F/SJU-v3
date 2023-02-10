<?php

namespace App\Http\Controllers\Admin\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course\Questionnaire;
use App\Http\Resources\QuestionnaireResource;

class QuestionnaireController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Questionnaire::class, 'questionnaire');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionnaires = Questionnaire::filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Courses/Questionnaires/Index', [
            'questionnaires' => QuestionnaireResource::collection($questionnaires)
                ->additional([
                    'can_create' => request()->user()->can('create', Questionnaire::class),
                ]),
            'filters' => request()->only(['perPage', 'search', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Courses/Questionnaires/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        // Store it
        $questionnaire = Questionnaire::create($data);

        // Redirect to edit template.
        return redirect()->route('admin.questions.index', $questionnaire->id)->with('message', __('Questionnaire created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        return inertia('Admin/Courses/Questionnaires/Edit', [
            'questionnaire' => new QuestionnaireResource($questionnaire)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        $request->merge(['status' => $request->boolean('status')]);
        $data = $request->validate([
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        // Store it
        $questionnaire->update($data);

        // Redirect to edit template.
        return redirect()->route('admin.questionnaires.index')->with('message', __('Questionnaire updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire)
    {
        $questionnaire->delete();
        return redirect()->back()->with('message', __('Questionnaire deleted successfully'));
    }
}
