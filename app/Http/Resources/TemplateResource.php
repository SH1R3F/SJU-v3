<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TemplateResource extends JsonResource
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
                'file' => $this->when($this->file, Storage::url($this->file)),
                'preview' => $this->when($this->preview, Storage::url($this->preview)),

                // Authorization
                $this->mergeWhen(str_contains(request()->route()->getActionName(), '@index'), [
                    'editable'   => $request->user()->can('update', $this->resource),
                    'deleteable' => $request->user()->can('delete', $this->resource),
                ])
            ],
        );
    }
}
