<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
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
                'candidate' => new MemberResource($this->whenLoaded('candidate')),
                'votes' => $this->whenLoaded('votes'),
                'votes_count' => $this->votes_count,

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }


    private function withAuthorization($request)
    {
        // Only for admin panel member's resource
        if (in_array($request->route()->getAction()['as'], ['admin.candidates.index'])) {
            return [
                'deleteable' => $request->user()->can('delete', $this->resource),
            ];
        }
        return [];
    }
}
