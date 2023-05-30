<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrainingBagRequest extends FormRequest
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
                Rule::when(request()->isMethod('POST'), ['required', 'file', 'mimes:pdf,doc,docx,xslx,ppt,pptx', 'max:300000'], 'nullable')
            ],
        ];
    }
}
