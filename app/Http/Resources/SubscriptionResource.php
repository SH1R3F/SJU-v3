<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'member' => new MemberResource($this->whenLoaded('member')),
            'type' => __(config('sju.memberships')[$this->type]['name']),
            'num' => $this->type,
            'start_date' => $this->start_date?->translatedFormat('l jS F Y'),
            'end_date' => $this->end_date?->translatedFormat('l jS F Y'),
            'status' => $this->status
        ];
    }
}
