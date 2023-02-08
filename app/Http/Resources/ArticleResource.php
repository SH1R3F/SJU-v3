<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{

    public static $wrap = null;


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),


            [
                'title' => app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en,
                'summary' => app()->getLocale() == 'ar' ? $this->summary_ar : $this->summary_en,
                'content' => app()->getLocale() == 'ar' ? $this->content_ar : $this->content_en,
                'article_category' => $this->article_category,
                'image' => $this->when($this->image, Storage::url($this->image), null),
                'images' => collect($this->images)->filter(fn ($img) => Storage::exists($img))->map(fn ($img) => Storage::url($img)),
                'category' => new CategoryResource($this->whenLoaded('category')),

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }

    private function withAuthorization($request)
    {
        if (!str_contains(request()->route()->getActionName(), '@index')) return [];

        return [
            'editable'   => $request->user()->can('update', $this->resource),
            'deleteable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
