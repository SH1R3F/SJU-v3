<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question' => ['required', 'string', 'max:255'],
            'commentable' => ['required', 'boolean'],
            'answer1' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'color1' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'answer2' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'color2' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'answer3' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'color3' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'answer4' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'color4' => ['nullable', 'required_unless:commentable,true', 'string', 'max:255'],
            'order' => ['nullable', 'numeric'],
            'status' => ['required', 'boolean']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->boolean('status')
        ]);
    }
}
