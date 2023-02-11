<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'name' => [
                'required',
                'max:255',
                Rule::when(request()->isMethod('POST'), Rule::unique('roles'), Rule::unique('roles')->ignore($this->role))
            ],
            'permissions' => ['present', 'array'],
            'permissions.*' => ['nullable', 'string', 'exists:permissions,name']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'permissions' => $this->permissions ? array_keys(array_filter($this->permissions ?? [])) : $this->permissions
        ]);
    }
}
