<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseResource extends JsonResource
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
                'course_type' => $this->course_type,
                'course_category' => $this->course_category,
                'course_gender' => $this->course_gender,
                'course_place' => $this->course_place,
                'state' => __($this->state($this->status)),
                'image' => $this->when($this->image, Storage::url($this->image)),
                'images' => collect($this->images)->map(fn ($img) => Storage::url($img)),

                // Authorization
                $this->mergeWhen(str_contains(request()->route()->getActionName(), '@index'), [
                    'viewable'   => $request->user()->can('view', $this->resource),
                    'editable'   => $request->user()->can('update', $this->resource),
                    'deleteable' => $request->user()->can('delete', $this->resource),
                ])
            ]
        );
    }
}
