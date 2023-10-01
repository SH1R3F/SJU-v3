<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'lname_ar' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::when(request()->isMethod('POST'), Rule::unique('admins'), Rule::unique('admins')->ignore($this->employee))
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::when(request()->isMethod('POST'), Rule::unique('admins'), Rule::unique('admins')->ignore($this->employee))
            ],
            'mobile' => [
                'nullable',
                'numeric',
                'digits_between:1,13',
                Rule::when(request()->isMethod('POST'), Rule::unique('admins'), Rule::unique('admins')->ignore($this->employee))
            ],
            'branch_id' => [Auth::user()->hasRole('Site admin') ? 'required' : 'nullable', 'numeric', 'exists:branches,id'],
            'password' => [
                Rule::when(request()->isMethod('POST'), 'required', 'nullable'),
                'string',
                'min:6',
                'max:255',
                'confirmed'
            ]
        ];
    }
}
