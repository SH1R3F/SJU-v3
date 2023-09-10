<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MembershipTransferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'member' => new MemberResource($this->whenLoaded('member')),
            'branchFrom' => new BranchResource($this->whenLoaded('branchFrom')),
            'branchTo' => new BranchResource($this->whenLoaded('branchTo')),
            'requester' => new AdminResource($this->whenLoaded('requester')),
            'accepter' => new AdminResource($this->whenLoaded('accepter')),
            'state' => $this->state()
        ]);
    }
}
