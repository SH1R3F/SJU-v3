<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
        return array_merge(parent::toArray($request), [
            'fullName' => $this->fullName,
            'role' => count($this->getRoleNames('name')) ? $this->getRoleNames('name')[0] : '',
            'branch' => $this->whenLoaded('branch'),
            'permissions' => $this->getPermissionsViaRoles()->pluck('id', 'name')->map(fn () => true),

            // Authorization
            $this->mergeWhen(str_contains(request()->route()->getActionName(), '@index'), [
                'editable'   => $request->user()->can('update', $this->resource),
                'toggleable' => $request->user()->can('toggle', $this->resource),
                'deleteable' => $request->user()->can('delete', $this->resource),
            ])
        ]);
    }
}
