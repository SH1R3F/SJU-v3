<?php

namespace App\Http\Requests\Volunteer;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fname_en'         => ['required', 'string', 'max:255'],
            'sname_en'         => ['required', 'string', 'max:255'],
            'tname_en'         => ['required', 'string', 'max:255'],
            'lname_en'         => ['required', 'string', 'max:255'],
            'gender'           => ['required', 'string', 'in:male,female'],
            'birthday'         => ['required', 'date'],
            'country'          => ['required', 'string', Rule::in(array_keys(config('sju.countries')))],
            'city'             => ['nullable', 'required_if:country,المملكة العربية السعودية', 'numeric', Rule::in(array_keys(config('sju.cities')))],
            'nationality'      => ['required', 'string', Rule::in(array_keys(config('sju.nationalities_ar')))],
            'qualification'    => ['required', 'numeric', Rule::in(array_keys(config('sju.qualifications')))],
            'national_id'      => ['required', 'numeric', Rule::unique('volunteers')],
            'marital_status'   => ['required', 'string', 'max:255'],
            'region'           => ['required', 'string', 'max:255'],
            'governorate'      => ['required', 'string', 'max:255'],
            'national_address' => ['required', 'string', 'max:255'],
            'job_title'        => ['required', 'string', 'max:255'],
            'residence'        => ['required', 'string', 'max:255'],
            'fields'           => ['required', 'array'],
            'education_level'  => ['required', 'string', 'max:255'],
            'experiences'      => ['required', 'string', 'max:255'],
            'branch_id'        => ['required', 'numeric', 'exists:branches,id'],
            'hearabout'        => ['required', 'numeric', Rule::in(array_keys(config('sju.sources')))],
            'mobile'           => ['required', 'numeric'],
            'mobile_key'       => ['required', 'numeric', Rule::in(array_values(config('sju.countries')))],
            'email'            => ['required', 'email', 'unique:volunteers'],
            'password'         => ['required', 'min:6', 'confirmed'],
            'agreement'        => ['accepted']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'fields' => array_keys(array_filter($this->fields ?? []))
        ]);
    }
}
