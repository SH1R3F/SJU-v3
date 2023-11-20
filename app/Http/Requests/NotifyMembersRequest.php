<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotifyMembersRequest extends FormRequest
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
            'message' => ['required', 'string'],
            'via' => ['required', 'array'],
            'via.*' => ['required', 'string', 'in:mail,sms,database'],
            'to_type' => ['required', 'string', 'in:select,all,fulltime,parttime,affiliate'],
            'recipients' => ['required_if:to_type,select', 'array'],
            'recipients.*' => ['required_if:to_type,select', 'numeric', 'exists:members,id'],
            'branch' => ['required', Rule::when(
                is_numeric($this->branch),
                Rule::exists('branches', 'id'),
                Rule::in(['all'])
            )],
            'status' => ['required', 'string', 'in:all,members,branch_approval,admin_approval,refused']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'via' => $this->via ? array_keys(array_filter($this->via ?? [])) : $this->via
        ]);
    }
}
