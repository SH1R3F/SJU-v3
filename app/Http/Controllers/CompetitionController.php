<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\CompetitionField;
use App\Models\CompetitionAnswer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CompetitionResource;
use App\Http\Requests\SubmitCompetitionRequest;
use App\Models\CompetitionSubmittion;

class CompetitionController extends Controller
{

    private $auth = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::guard('member')->check()) {
                $this->auth = Auth::guard('member')->user();
            } else if (Auth::guard('subscriber')->check()) {
                $this->auth = Auth::guard('subscriber')->user();
            } else if (Auth::guard('volunteer')->check()) {
                $this->auth = Auth::guard('volunteer')->user();
            }

            return $next($request);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Competition $competition)
    {
        abort_if(!$competition->status, 404);

        return inertia('Competitions/Show', [
            'competition' => new CompetitionResource($competition->load('fields')),
            'registered' => $this->auth ? !!$this->auth->submissions()->where('competition_id', $competition->id)->first() : false
        ]);
    }

    /**
     * Submit solved competition fields.
     */
    public function submit(SubmitCompetitionRequest $request, Competition $competition)
    {
        abort_if(!$competition->status, 404);

        $data = $request->validated();

        if ($this->auth) {
            $submission = $this->auth->submissions()->create(['competition_id' => $competition->id]);
        } else {
            $submission = CompetitionSubmittion::create(['competition_id' => $competition->id]);
        }

        foreach ($data['competition_fields'] as $competition_answer) {
            $field = CompetitionField::find($competition_answer['id']);

            if (!$field) continue;

            if ($field->type === 'file' && $competition_answer['answer'] instanceof UploadedFile) {
                $competition_answer['answer'] = $competition_answer['answer']->store("competitions/files");
            }

            $answer = [
                'answer_text' => $field->type === 'text' ? $competition_answer['answer'] : null,
                'answer_file' => $field->type === 'file' ? $competition_answer['answer'] : null,
                'answer_date' => $field->type === 'date' ? $competition_answer['answer'] : null,
                'competition_field_id' => $field->id,
            ];

            $submission->answers()->create($answer);
        }

        return redirect()->back()->with('message', __("You submitted successfully"));
    }
}
