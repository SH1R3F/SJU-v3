<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
                'slug' => app()->getLocale() == 'ar' ? $this->slug_ar : $this->slug_en,
                'title' => app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en,

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
