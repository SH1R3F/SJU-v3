<?php

namespace App\Http\Requests\Member;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileInfoRequest extends FormRequest
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
            'national_id_source' => ['required', 'string', 'max:255'],
            'national_id_date' => ['required', 'date', 'date_format:Y/m/d'],
            'qualification' => ['required', 'string', 'max:255'],
            'major' => ['required', 'string', 'max:255'],
            'journalistic_profession' => ['required', 'string', 'max:255'],
            'journalistic_employer' => ['required', 'string', 'max:255'],
            'newspaper_type' => ['required', 'numeric', 'in:1,2'],
            'non_journalistic_profession' => ['required', 'string', 'max:255'],
            'non_journalistic_employer' => ['required', 'string', 'max:255'],
            'workphone' => ['required', 'numeric'],
            'workphone_ext' => ['required', 'numeric'],
            'fax' => ['required', 'numeric'],
            'fax_ext' => ['required', 'numeric'],
            'postbox' => ['required', 'numeric'],
            'postcode' => ['required', 'numeric'],
            'postcity' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('members')->ignore(Auth::guard('member')->user())]
        ];
    }
}
