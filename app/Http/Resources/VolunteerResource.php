<?php

namespace App\Http\Resources;

use App\Http\Resources\BranchResource;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class VolunteerResource extends JsonResource
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
                'fullName_ar' => $this->full_name_ar,
                'fullName_en' => $this->full_name_en,
                'age' => $this->age,
                'phone_number' => $this->prepareMobileForSms(),
                'state' => $this->status == 1 ? __('Active') : __('Inactive'),
                'profile_photo' => $this->when($this->profile_photo, Storage::url($this->profile_photo), null),

                'courses' => CourseResource::collection($this->whenLoaded('courses')),
                'courses_count' => $this->courses_count,
                'branch' => new BranchResource($this->whenLoaded('branch')),
                'branch_name' => $this->branch_name,

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
                'toggleable' => $request->user()->can('update', $this->resource),
                'viewable'   => $request->user()->can('view', $this->resource),
                'editable'   => $request->user()->can('update', $this->resource),
                'deleteable' => $request->user()->can('delete', $this->resource),
            ];
        }
        return [];
    }
}
