<?php

namespace App\Http\Resources;

use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Subscriber;
use App\Http\Resources\MemberResource;
use App\Http\Resources\VolunteerResource;
use App\Http\Resources\SubscriberResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetitionSubmissionResource extends JsonResource
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
                'userable' => $this->userableResource(),
                'answers' => CompetitionAnswerResource::collection($this->whenLoaded('answers')),
                'competition' => new CompetitionResource($this->whenLoaded('competition')),
            ]
        );
    }

    private function userableResource()
    {
        if (!$this->userable) {
            return null;
        }

        if ($this->userable instanceof Member) {
            return new MemberResource($this->whenLoaded('userable'));
        }

        if ($this->userable instanceof Subscriber) {
            return new SubscriberResource($this->whenLoaded('userable'));
        }

        if ($this->userable instanceof Volunteer) {
            return new VolunteerResource($this->whenLoaded('userable'));
        }
    }
}
