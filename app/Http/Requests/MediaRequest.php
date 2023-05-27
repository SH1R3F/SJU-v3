<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
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
            'type' => ['required', 'in:photo,video'],
            'upload' => ['required', 'boolean'],
            'file' => [
                'nullable',
                'required_without:link',
                'file',
                Rule::when($this->type == 'photo', 'mimes:jpeg,png,jpg,gif,svg', 'mimes:mp4,ogx,oga,ogv,ogg,webm'),
                'max:200480'
            ],
            'link' => [
                'nullable',
                'required_without:file',
                'url',
            ],
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'upload' => $this->boolean('upload')
        ]);
    }
}
