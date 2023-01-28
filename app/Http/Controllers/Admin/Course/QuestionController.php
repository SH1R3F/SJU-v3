<?php

namespace App\Http\Controllers\Admin\Course;

use Illuminate\Http\Request;
use App\Models\Course\Question;
use App\Http\Controllers\Controller;
use App\Models\Course\Questionnaire;
use App\Http\Requests\Course\QuestionRequest;
use App\Http\Resources\QuestionnaireResource;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function index(Questionnaire $questionnaire)
    {
        $this->authorize('view', $questionnaire);
        return inertia('Admin/Courses/Questionnaires/Questions/Index', [
            'questionnaire' => new QuestionnaireResource($questionnaire->load('questions'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function create(Questionnaire $questionnaire)
    {
        $this->authorize('view', $questionnaire);

        return inertia('Admin/Courses/Questionnaires/Questions/Create', ['id' => $questionnaire->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Course\QuestionRequest  $request
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request, Questionnaire $questionnaire)
    {
        $this->authorize('view', $questionnaire);
        $questionnaire->questions()->create($request->validated());
        return redirect()->route('admin.questions.index', $questionnaire->id)->with('message', __('Question created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @param  \App\Models\Course\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire, Question $question)
    {
        $this->authorize('view', $questionnaire);
        return inertia('Admin/Courses/Questionnaires/Questions/Edit', [
            'id' => $questionnaire->id,
            'question' => new QuestionResource($question)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Course\QuestionRequest  $request
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @param  \App\Models\Course\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Questionnaire $questionnaire, Question $question)
    {
        $this->authorize('view', $questionnaire);
        $question->update($request->validated());
        return redirect()->route('admin.questions.index', $questionnaire->id)->with('message', __('Question updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     * @param  \App\Models\Course\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        $question->delete();
        return redirect()->back()->with('message', __('Question deleted successfully'));
    }
}
