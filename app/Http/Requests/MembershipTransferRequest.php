<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MembershipTransferRequest extends FormRequest
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
            'national_id' => ['required', 'numeric', 'exists:members'],
            'transfer_to' => Rule::when(request()->user()?->hasRole('Site admin'), ['required', 'exists:branches,id'], ['nullable'])
        ];
    }


    public function messages()
    {
        return [
            'national_id.exists' => __("Member with this national id doesn't exist")
        ];
    }
}
