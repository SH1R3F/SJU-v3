<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitCompetitionRequest extends FormRequest
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
            'competition_fields' => ['required', 'array'],
            'competition_fields.*' => ['required', 'array'],
            'competition_fields.*.id' => ['required', 'exists:competition_fields'],
            'competition_fields.*.type' => ['required'],
            'competition_fields.*.answer' => ['nullable'],
        ];
    }
}
