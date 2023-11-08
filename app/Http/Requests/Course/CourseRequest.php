<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:255'],
            'course_type_id' => ['nullable', 'numeric', 'exists:courses_types,id'],
            'course_category_id' => ['nullable', 'numeric', 'exists:courses_categories,id'],
            'course_gender_id' => ['nullable', 'numeric', 'exists:courses_genders,id'],
            'course_branch_id' => ['nullable', 'numeric', 'exists:branches,id'],
            'map_link' => ['nullable', 'url', 'max:255'],
            'lng' => ['nullable'],
            'lat' => ['nullable'],
            'seats' => ['nullable', 'numeric', 'max:1000'],
            'status' => ['nullable', 'numeric'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
            'time_from' => ['required'],
            'time_to' => ['required'],
            'days' => ['required', 'array'],
            'minutes' => ['nullable', 'numeric'],
            'percentage' => ['nullable', 'numeric'],
            'cost' => ['nullable', 'numeric', 'in:0,1,2'],
            'price' => ['nullable', 'numeric'],
            'currency' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['nullable', 'string', 'max:255'],
            'images' => ['nullable', 'array'],
            'image.*' => ['nullable', 'string'],
            'trainer' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'zoom' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'template_id' => ['nullable', 'numeric', 'exists:courses_templates,id'],
            'questionnaire_id' => ['nullable', 'numeric', 'exists:courses_questionnaires,id'],
            'attendance_mins' => ['nullable', 'numeric'],
        ];
    }
}
