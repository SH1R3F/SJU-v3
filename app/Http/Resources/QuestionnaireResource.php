<?php

namespace App\Http\Resources;

use App\Http\Resources\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionnaireResource extends JsonResource
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
                'name' => app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en,
                'state' => $this->status ? __('Active') : __('Inactive'),

                'questions' => $this->when($this->relationLoaded('questions'), QuestionResource::collection($this->questions()->orderBy('order')->orderBy('id')->get())),

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }

    private function withAuthorization($request)
    {
        if (!str_contains(request()->route()->getActionName(), '@index')) return [];

        return [
            'viewable'   => $request->user()->can('view', $this->resource),
            'editable'   => $request->user()->can('update', $this->resource),
            'deleteable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
