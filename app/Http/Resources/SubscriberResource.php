<?php

namespace App\Http\Resources;

use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
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
                'fullName' => $this->full_name,
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
        if (in_array($request->route()->getAction()['as'], ['admin.subscribers.index'])) {
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
