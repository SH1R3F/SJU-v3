<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'news_date' => ['required', 'date'],
            'images' => ['nullable', 'array'],
            // 'image.*' => ['nullable', 'string'],
            'summary_ar' => ['required', 'string', 'max:255'],
            'summary_en' => ['nullable', 'string', 'max:255'],
            'content_ar' => ['required', 'string'],
            'content_en' => ['nullable', 'string'],
        ];
    }
}
