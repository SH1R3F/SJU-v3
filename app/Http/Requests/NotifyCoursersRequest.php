<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotifyCoursersRequest extends FormRequest
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
            'message' => ['required', 'string'],
            'via' => ['required', 'array'],
            'via.*' => ['required', 'string', 'in:mail,sms'],
            'to_type' => ['required', 'string', 'in:select,all,passed,unpassed'],
            'recipients' => ['required_if:to_type,select', 'array'],
            'recipients.*' => ['required_if:to_type,select']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'via' => $this->via ? array_keys(array_filter($this->via ?? [])) : $this->via
        ]);
    }
}
