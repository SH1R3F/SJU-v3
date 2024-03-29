<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompetitionRequest extends FormRequest
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
            'status' => ['required', 'boolean'],
            'allow_guests' => ['required', 'boolean'],
            'competition_fields' => ['required', 'array'],
            'competition_fields.*' => ['required', 'array'],
            'competition_fields.*.id' => ['nullable'],
            'competition_fields.*.title' => ['required', 'string', 'max:255'],
            'competition_fields.*.type' => ['required', 'string', 'in:text,date,file'],
            'competition_fields.*.required' => ['required', 'boolean'],
        ];
    }
}
