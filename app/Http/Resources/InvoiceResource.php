<?php

namespace App\Http\Resources;

use App\Http\Resources\MemberResource;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'amount' => $this->amount,
            'member_id' => $this->member_id,
            'member' => new MemberResource($this->whenLoaded('member')),
            'subscription_id' => $this->subscription_id,
            'subscription' => new SubscriptionResource($this->whenLoaded('subscription')),
            'created_at' => $this->created_at?->translatedFormat('l jS F Y'),
        ];
    }
}
