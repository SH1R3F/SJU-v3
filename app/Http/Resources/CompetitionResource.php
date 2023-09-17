<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'fields' => $this->whenLoaded('fields'),
                'status'  => strval($this->status),
                'state'  => $this->status ? __('Active') : __('Inactive'),
                'submissions' => CompetitionSubmissionResource::collection($this->whenLoaded('submissions')),

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }

    private function withAuthorization($request)
    {
        if (str_contains(request()->route()->getActionName(), '@index') && strpos($request->route()->getAction()['as'], 'dmin')) {
            return [
                'viewable'     => $request->user()->can('view', $this->resource),
                'editable'     => $request->user()->can('update', $this->resource),
                'deleteable'   => $request->user()->can('delete', $this->resource),
            ];
        }
        return [];
    }

}
