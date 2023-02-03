<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteer extends FormRequest
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
            'profile_photo'    => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'fname_ar'         => ['required', 'string', 'max:255'],
            'sname_ar'         => ['required', 'string', 'max:255'],
            'tname_ar'         => ['required', 'string', 'max:255'],
            'lname_ar'         => ['required', 'string', 'max:255'],
            'fname_en'         => ['nullable', 'string', 'max:255'],
            'sname_en'         => ['nullable', 'string', 'max:255'],
            'tname_en'         => ['nullable', 'string', 'max:255'],
            'lname_en'         => ['nullable', 'string', 'max:255'],
            'gender'           => ['required', 'string', 'in:male,female'],
            'country'          => ['required', 'string', Rule::in(array_keys(config('sju.countries')))],
            'city'             => ['nullable', 'required_if:country,المملكة العربية السعودية', 'numeric', Rule::in(array_keys(config('sju.cities')))],
            'nationality'      => ['required', 'string', Rule::in(array_keys(config('sju.nationalities_ar')))],
            'qualification'    => ['required', 'numeric', Rule::in(array_keys(config('sju.qualifications')))],
            'national_id'      => [
                'required', 'numeric',
                Rule::when(
                    request()->isMethod('POST'),
                    Rule::unique('volunteers'),
                    Rule::unique('volunteers')->ignore($this->volunteer),
                )

            ],
            'marital_status'   => ['nullable', 'string', 'max:255'],
            'region'           => ['nullable', 'string', 'max:255'],
            'governorate'      => ['nullable', 'string', 'max:255'],
            'national_address' => ['nullable', 'string', 'max:255'],
            'job_title'        => ['nullable', 'string', 'max:255'],
            'residence'        => ['nullable', 'string', 'max:255'],
            'fields'           => ['nullable', 'array'],
            'education_level'  => ['nullable', 'string', 'max:255'],
            'experiences'      => ['nullable', 'string', 'max:255'],
            'mobile'           => ['required', 'numeric'],
            'mobile_key'       => ['required', 'numeric', Rule::in(array_values(config('sju.countries')))],
            'email'            => [
                'required', 'email',
                Rule::when(
                    request()->isMethod('POST'),
                    Rule::unique('volunteers'),
                    Rule::unique('volunteers')->ignore($this->volunteer),
                )
            ],
            'password' => ['nullable', 'min:6'],
            'branch_id'        => ['required', 'numeric', 'exists:branches,id'],
        ];
    }
}
