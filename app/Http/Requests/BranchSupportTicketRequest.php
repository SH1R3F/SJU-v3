<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchSupportTicketRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'attachment' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048']
        ];
    }
}
