<?php

namespace App\Http\Resources;

use App\Http\Resources\InviteResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
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
                'file' => $this->when($this->file, Storage::url($this->file)),
                'preview' => $this->when($this->preview, Storage::url($this->preview)),
                'invites' => InviteResource::collection($this->whenLoaded('invites')),
                'welcome_message' => $this->welcome_message,

                // Authorization
                $this->mergeWhen(str_contains(request()->route()->getActionName(), '@index'), $this->withAuthorization($request))
            ],
        );
    }

    public function withAuthorization($request)
    {
        if (!str_contains(request()->route()->getActionName(), '@index')) return [];
        return [
            'viewable'   => $request->user()->can('view', $this->resource),
            'editable'   => $request->user()->can('update', $this->resource),
            'toggleable' => $request->user()->can('toggle', $this->resource),
            'deleteable' => $request->user()->can('delete', $this->resource),
        ];
    }
}
