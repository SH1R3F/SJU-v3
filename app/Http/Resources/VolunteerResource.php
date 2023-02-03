<?php

namespace App\Http\Resources;

use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VolunteerResource extends JsonResource
{
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
                'fullName' => app()->getLocale() == 'ar' ? $this->full_name_ar : $this->full_name_en,
                'fullName_ar' => $this->full_name_ar,
                'fullName_en' => $this->full_name_en,
                'phone_number' => $this->prepareMobileForSms(),
                'state' => $this->status == 1 ? __('Active') : __('Inactive'),

                'courses' => CourseResource::collection($this->whenLoaded('courses')),
                'courses_count' => $this->courses_count,

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }


    private function withAuthorization($request)
    {
        // Only for admin panel member's resource
        if (in_array($request->route()->getAction()['as'], ['admin.volunteers.index'])) {
            return [
                'viewable'   => $request->user()->can('view', $this->resource),
                'toggleable' => $request->user()->can('update', $this->resource),
                'editable'   => $request->user()->can('update', $this->resource),
                'deleteable' => $request->user()->can('delete', $this->resource),
            ];
        }
        return [];
    }
}
