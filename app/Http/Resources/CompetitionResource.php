<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            [
                'fields' => $this->whenLoaded('fields'),
                'state'  => $this->status ? __('Active') : __('Inactive'),

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
