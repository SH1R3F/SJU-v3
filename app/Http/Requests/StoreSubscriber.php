<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriber extends FormRequest
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
            'gender' => ['required', 'string', 'in:male,female'],
            'country' => ['required', 'string', Rule::in(array_keys(config('sju.countries')))],
            'city' => ['nullable', 'required_if:country,المملكة العربية السعودية', 'numeric', Rule::in(array_keys(config('sju.cities')))],
            'nationality' => ['required', 'string', Rule::in(array_keys(config('sju.nationalities_ar')))],
            'qualification' => ['required', 'numeric', Rule::in(array_keys(config('sju.qualifications')))],
            'mobile' => ['required', 'numeric'],
            'mobile_key' => ['required', 'numeric', Rule::in(array_values(config('sju.countries')))],
            'email' => [
                'required', 'email',
                Rule::when(
                    request()->isMethod('POST'),
                    Rule::unique('subscribers'),
                    Rule::unique('subscribers')->ignore($this->subscriber),
                )
            ],
            'password' => ['nullable', 'min:6'],
        ];
    }
}
