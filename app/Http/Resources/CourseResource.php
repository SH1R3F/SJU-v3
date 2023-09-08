<?php

namespace App\Http\Resources;

use App\Http\Resources\MemberResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\VolunteerResource;
use App\Http\Resources\SubscriberResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
                'course_branch' => $this->course_branch,
                'branch' => new BranchResource($this->whenLoaded('branch')),
                'category' => $this->whenLoaded('category'),
                'state' => __($this->state($this->status)),
                'image' => $this->when($this->image, Storage::url($this->image), null),
                'images' => collect($this->images)->filter(fn ($img) => Storage::exists($img))->map(fn ($img) => Storage::url($img)),
                'days' => array_map(fn ($day) => true, array_combine($this->days ?? [], $this->days ?? []) ?? []),

                // Coursables
                'members' => MemberResource::collection($this->whenLoaded('members')),
                'subscribers' => SubscriberResource::collection($this->whenLoaded('subscribers')),
                'volunteers' => VolunteerResource::collection($this->whenLoaded('volunteers')),

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }

    private function withAuthorization($request)
    {
        if (str_contains(request()->route()->getActionName(), '@index') && strpos($request->route()->getAction()['as'], 'dmin')) {
            return [
                'questionable' => $request->user()->can('view', $this->questionnaire),
                'viewable'     => $request->user()->can('view', $this->resource),
                'editable'     => $request->user()->can('update', $this->resource),
                'toggleable'   => $request->user()->can('toggle', $this->resource),
                'deleteable'   => $request->user()->can('delete', $this->resource),
            ];
        }
        return [];
    }
}
