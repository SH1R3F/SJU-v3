<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingBagResource extends JsonResource
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
                'path' => Storage::url($this->path),

                // Authorization
                $this->mergeWhen(str_contains(request()->route()->getActionName(), '@index'), [
                    'editable'   => $request->user()?->can('update', $this->resource),
                    'deleteable' => $request->user()?->can('delete', $this->resource),
                ])
            ]
        );
    }
}
