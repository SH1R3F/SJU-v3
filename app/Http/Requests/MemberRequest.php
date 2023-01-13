<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Rules\MemberUniqueMobile;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'fname_ar' => ['required', 'string', 'max:255'],
            'sname_ar' => ['required', 'string', 'max:255'],
            'tname_ar' => ['required', 'string', 'max:255'],
            'lname_ar' => ['required', 'string', 'max:255'],
            'fname_en' => ['nullable', 'string', 'max:255'],
            'sname_en' => ['nullable', 'string', 'max:255'],
            'tname_en' => ['nullable', 'string', 'max:255'],
            'lname_en' => ['nullable', 'string', 'max:255'],
            'national_id' => ['required', 'numeric', 'digits_between:9,10', 'unique:members'],
            'mobile' => ['required', 'numeric', 'regex:/^(5)\d{8}$/', new MemberUniqueMobile],
            'gender' => ['required', 'boolean'],
            'birthday_h' => ['required', 'date', 'date_format:Y/m/d'],
            'birthday_m' => ['required', 'date', 'date_format:Y-m-d'],
            'nationality' => ['required', 'string', Rule::in(array_keys(config('sju.nationalities', [])))],
            'qualification' => ['required', 'string', 'max:255'],
            'major' => ['required', 'string', 'max:255'],
            'journalistic_profession' => ['required', 'string', 'max:255'],
            'journalistic_employer' => ['required', 'string', 'max:255'],
            'newspaper_type' => ['required', 'numeric', 'in:1,2'],
            'non_journalistic_profession' => ['required', 'string', 'max:255'],
            'non_journalistic_employer' => ['required', 'string', 'max:255'],
            'workphone' => ['required', 'numeric'],
            'workphone_ext' => ['required', 'numeric'],
            'fax' => ['nullable', 'numeric'],
            'fax_ext' => ['nullable', 'numeric'],
            'postbox' => ['nullable', 'numeric'],
            'postcode' => ['nullable', 'numeric'],
            'postcity' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:members'],
            'branch_id' => ['required', 'numeric', 'exists:branches,id'],
            'type' => ['required', 'numeric', 'in:1,2,3'],
        ];
    }
}
