<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' => $this->name,
            'users_count' => $this->whenCounted('users'),
            'admins' => AdminResource::collection($this->whenLoaded('users')),
            'permissions' => $this->whenLoaded('permissions')->pluck('id', 'name')->map(fn () => true),
            'created_at' => $this->created_at,
            'can' => $this->whenAppended('can', [
                'edit' => $request->user()->can('update', $this->resource),
                'delete' => $request->user()->can('delete', $this->resource),
            ])
        ];
    }
}
