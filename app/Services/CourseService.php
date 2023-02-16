<?php

namespace App\Services;

use App\Models\Course\Course;
use App\Models\Course\Question;
use App\Models\Course\Questionnaire;

class CourseService
{

    /**
     * Create a new course
     */
    public function create(array $data)
    {
        // Handle images uploads
        $data['images'] = $this->handleImages($data['images'], $data['date_from']);
        // Set first image as the default one
        $data['image'] = count($data['images']) ? $data['images'][0] : null;

        // Set course number
        $data['course_number'] = $this->courseNumber();
        return Course::create($data);
    }

    /**
     * Update an existing course
     */
    public function update(array $data, Course $course)
    {
        // Handle images uploads
        $data['images'] = $this->handleImages($data['images'], $data['date_from'], $course->images);
        // Set first image as the default one
        $data['image'] = count($data['images']) ? $data['images'][0] : null;

        $course->update($data);
    }


    /**
     * Handle course image calculations
     */
    private function handleImages(array $images, $date_from, array $oldies = [])
    {
        // Should I delete previous images and reset them?

        $imgs = [];
        foreach ($images as $img) {
            if (str_starts_with($img, 'data:image')) {
                $path = upload_base64_image($img, "uploads/images/$date_from");
                array_push($imgs, $path);
                continue;
            }

            // Previous photos? [urls]
            foreach ($oldies as $oldie) {
                if (strpos($img, $oldie)) {
                    array_push($imgs, $oldie);
                    break;
                }
            }
        }
        return $imgs;
    }

    /**
     * Generate course number
     */
    private function courseNumber()
    {
        $last = Course::orderBy('course_number', 'DESC')->first();
        if (!$last || !$last->course_number) return 'SJU-0001';

        $num = intval(explode('-', $last->course_number)[1]);
        return "SJU-" . str_pad($num + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Prepare questionnaire result for display
     * 
     * @param  \App\Models\Course\Course  $course
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     */
    public function questionnaireResults(Course $course, Questionnaire $questionnaire)
    {
        $questionnables = $course->questionable_subscribers()->withPivot('answers')->get();
        $questionnables = $questionnables->merge($course->questionable_members()->withPivot('answers')->get());
        $questionnables = $questionnables->merge($course->questionable_volunteers()->withPivot('answers')->get());

        $results = [];

        foreach ($questionnables as $questionnable) {
            $answers = collect(json_decode($questionnable->pivot->answers));

            $answers->each(function ($answer) use (&$results, $questionnable) {
                $question = Question::find($answer->id);
                if (!$question) return;

                if (isset($results[$question->id])) {
                    $answerers = $results[$question->id]['answerers'];
                    if ($question->commentable) {
                        array_push($answerers, [
                            'id' => $questionnable->id,
                            'type' => $questionnable->pivot->questionable_type,
                            'name' => $questionnable->full_name,
                            'answer' => $answer->answer,
                        ]);
                    }

                    $results[$question->id] = [
                        'type' => $question->commentable,
                        'answerers' => $answerers,
                        'a' => $answer->answer == 1 ? $results[$question->id]['a'] + 1 : $results[$question->id]['a'],
                        'b' => $answer->answer == 2 ? $results[$question->id]['b'] + 1 : $results[$question->id]['b'],
                        'c' => $answer->answer == 3 ? $results[$question->id]['c'] + 1 : $results[$question->id]['c'],
                        'd' => $answer->answer == 4 ? $results[$question->id]['d'] + 1 : $results[$question->id]['d'],
                    ];
                } else {
                    $results[$question->id] = [
                        'type' => $question->commentable,
                        'answerers' => $question->commentable ? [
                            [
                                'id' => $questionnable->id,
                                'type' => $questionnable->pivot->questionable_type,
                                'name' => $questionnable->full_name,
                                'answer' => $answer->answer,
                            ]
                        ] : [],
                        'a' => $answer->answer == 1 ? 1 : 0,
                        'b' => $answer->answer == 2 ? 1 : 0,
                        'c' => $answer->answer == 3 ? 1 : 0,
                        'd' => $answer->answer == 4 ? 1 : 0,
                    ];
                }
            });
        }
        return [
            'course'    => $course,
            'answers'   => $results,
            'questions' => $questionnaire->questions()->orderBy('order', 'ASC')->get()
        ];
    }

    /**
     * Prepare questionnaire result for export
     * 
     * @param  \App\Models\Course\Course  $course
     * @param  \App\Models\Course\Questionnaire  $questionnaire
     */
    public function export(Course $course, Questionnaire $questionnaire)
    {
        $questionnables = $course->questionable_subscribers()->withPivot('answers')->get();
        $questionnables = $questionnables->merge($course->questionable_members()->withPivot('answers')->get());
        $questionnables = $questionnables->merge($course->questionable_volunteers()->withPivot('answers')->get());

        $results = [];

        foreach ($questionnables as $questionnable) {

            $row = [
                'type' => str_contains($questionnable->pivot->questionable_type, 'Member') ? __('Member') : (str_contains($questionnable->pivot->questionable_type, 'Subscriber') ? __('Subscriber') : __('Volunteer')),
                'name' => $questionnable->full_name,
            ];

            $answers = collect(json_decode($questionnable->pivot->answers));

            $answers->each(function ($answer) use (&$row) {
                $question = Question::find($answer->id);
                if (!$question) return;
                $row['answers'][$question->id] = $answer->answer == 1 ? 'A+' : ($answer->answer == 2 ? 'A' : ($answer->answer == 3 ? 'B' : ($answer->answer == 4 ? 'C' : $answer->answer)));
            });

            array_push($results, $row);
        }
        return [
            'answers'   => $results,
            'questions' => $questionnaire->questions()->orderBy('order', 'ASC')->get()->toArray()
        ];
    }
}
