<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class ProfileExperiencesRequest extends FormRequest
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
            'exp_flds_lngs' => ['required'],
            'exp_flds_lngs.experiences' => ['required', 'array'],
            'exp_flds_lngs.fields' => ['required', 'array'],
            'exp_flds_lngs.languages' => ['required', 'array'],
        ];
    }
}
