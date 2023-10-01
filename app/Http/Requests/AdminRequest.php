<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
                Rule::when(request()->isMethod('POST'), Rule::unique('admins'), Rule::unique('admins')->ignore($this->admin))
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::when(request()->isMethod('POST'), Rule::unique('admins'), Rule::unique('admins')->ignore($this->admin))
            ],
            'mobile' => [
                'nullable',
                'numeric',
                'digits_between:1,13',
                Rule::when(request()->isMethod('POST'), Rule::unique('admins'), Rule::unique('admins')->ignore($this->admin))
            ],
            'branch_id' => ['nullable', 'numeric', 'exists:branches,id'],
            'role'     => ['required', 'string', 'exists:roles,name'],
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
