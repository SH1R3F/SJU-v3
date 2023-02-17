<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'image' => [
                Rule::when(request()->isMethod('PUT'), 'nullable', 'required'),
                'file',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:20480'
            ],
            'link' => [
                'nullable',
                'url',
            ],
            'target' => ['nullable', 'in:_self,_blank'],
            'group' => ['required', 'in:3,2']
        ];
    }
}
