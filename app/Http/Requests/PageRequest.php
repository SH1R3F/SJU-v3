<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'slug_ar' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::when(
                    request()->isMethod('POST'),
                    Rule::unique('pages'),
                    Rule::unique('pages')->ignore($this->page)
                )
            ],
            'slug_en' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::when(
                    request()->isMethod('POST'),
                    Rule::unique('pages'),
                    Rule::unique('pages')->ignore($this->page)
                )
            ],
            'content_ar' => ['required', 'string'],
            'content_en' => ['nullable', 'string'],
        ];
    }
}
