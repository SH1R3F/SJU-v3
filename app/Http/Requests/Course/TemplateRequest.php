<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'file' => [
                Rule::when(request()->isMethod('POST'), ['required', 'file', 'mimes:pdf', 'max:10000'], 'nullable')
            ],
            'mode' => ['required', 'in:ar,en'],
            'layout' => ['required', 'in:A4,A4-L,A3,A3-L,Letter,Letter-L'],
            'variables' => ['nullable'],
            'with_title' => ['sometimes', 'boolean'],
            'male_title' => [
                Rule::when(request()->isMethod('POST'), 'nullable', 'nullable|required_if:with_title,1'), 'string', 'max:255'
            ],
            'female_title' => [
                Rule::when(request()->isMethod('POST'), 'nullable', 'nullable|required_if:with_title,1'), 'string', 'max:255'
            ],
            'qr_position' => [
                Rule::when(request()->isMethod('POST'), 'nullable', 'required'), 'in:none,top:1mm;right:1mm,top:1mm;right:50%,top:1mm;left:1mm,bottom:1mm;right:1mm,bottom:1mm;right:50%,bottom:1mm;left:1mm'
            ],
            'qr_margin_top' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
            'qr_margin_right' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
            'qr_margin_bottom' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
            'qr_margin_left' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'with_title' => $this->boolean('with_title'),
        ]);
    }
}
