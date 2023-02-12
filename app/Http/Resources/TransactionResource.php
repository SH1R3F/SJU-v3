<?php

namespace App\Http\Resources;

use App\Http\Resources\MemberResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'checkout_id' => $this->checkout_id,
            'payment_method' => $this->payment_method,
            'method' => $this->payment_method == 2 ? __('MADA') : __('VISA/MASTERCARD'),
            'member_id' => $this->member_id,
            'member' => new MemberResource($this->whenLoaded('member')),
            'cart_ref' => $this->cart_ref,
            'response' => $this->response,
            'created_at' => $this->created_at?->translatedFormat('l jS F Y g:i A'),
        ];
    }
}
