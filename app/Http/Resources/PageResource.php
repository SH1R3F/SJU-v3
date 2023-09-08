<?php

namespace App\Http\Resources;

use App\Services\PageService;
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
                'content' => $this->prepareForPress($this->content),

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

    private function prepareForPress($content)
    {
        $service = new PageService;
        if (str_contains($content, '[URLS_GROUP_3]')) {
            $content = $service->preparePressGroup(3, $content);
        }
        if (str_contains($content, '[URLS_GROUP_2]')) {
            $content = $service->preparePressGroup(2, $content);
        }
        return $content;
    }
}
