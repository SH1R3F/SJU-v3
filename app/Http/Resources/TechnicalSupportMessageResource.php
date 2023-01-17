<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class TechnicalSupportMessageResource extends JsonResource
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

            // 
            [
                'created_at' => $this->created_at?->format('g:i A'),
                'attachment' => $this->when($this->attachment, Storage::url($this->attachment), $this->attachment),
            ]
        );
    }
}
