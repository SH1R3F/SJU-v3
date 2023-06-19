<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'file' => [
                Rule::when(request()->isMethod('POST'), ['required', 'image', 'mimes:jpg,png,jpeg', 'max:10000'], 'nullable')
            ],
            'variables' => ['nullable'],
            'welcome_message' => ['required', 'string', 'max:255'],
            'qr_position' => [
                Rule::when(request()->isMethod('POST'), 'nullable', 'required'), 'in:none,top-right,top,top-left,bottom-right,bottom,bottom-left'
            ],
            'qr_position_x' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
            'qr_position_y' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
            'qr_size' => [
                Rule::when(request()->isMethod('POST'), 'nullable', ['nullable', 'required_unless:qr_position,none']), 'numeric'
            ],
        ];
    }
}
