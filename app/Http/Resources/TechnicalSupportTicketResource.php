<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Subscriber;
use App\Http\Resources\AdminResource;
use App\Http\Resources\VolunteerResource;
use App\Http\Resources\SubscriberResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TechnicalSupportMessageResource;

class TechnicalSupportTicketResource extends JsonResource
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
                'supportable' => $this->when($this->relationLoaded('supportable'), function () {
                    if ($this->supportable instanceof Member) {
                        return new MemberResource($this->supportable);
                    } else if ($this->supportable instanceof Subscriber) {
                        return new SubscriberResource($this->supportable);
                    } else if ($this->supportable instanceof Volunteer) {
                        return new VolunteerResource($this->supportable);
                    } else if ($this->supportable instanceof Admin) {
                        return new AdminResource($this->supportable);
                    }

                    return $this->supportable;
                }),
                'messages' => TechnicalSupportMessageResource::collection(
                    $this->when(
                        $this->relationLoaded('messages'),
                        fn () => $this->messages()->orderBy('id')->get()
                    )
                ),
                'updated_at' => $this->updated_at?->translatedFormat('l jS F Y'),

                // Authorization
                $this->merge($this->withAuthorization($request))
            ]
        );
    }

    /**
     * Authorization attributes
     */
    private function withAuthorization($request)
    {
        // Only for admin panel member's resource
        if (in_array($request->route()->getAction()['as'], ['admin.tickets.index', 'admin.tickets.subscribers', 'admin.tickets.volunteers', 'admin.tickets.managers'])) {
            return [
                'viewable'   => $request->user()->can('view', $this->resource),
                'deleteable' => $request->user()->can('delete', $this->resource),
            ];
        }
        return [];
    }
}
