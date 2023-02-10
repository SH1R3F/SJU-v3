<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MediaResource extends JsonResource
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
                'path' => $this->when(
                    filter_var($this->path, FILTER_VALIDATE_URL),
                    $this->youtubeIframe($this->path),
                    Storage::url($this->path)
                )
            ]
        );
    }

    private function youtubeIframe($url)
    {
        if (str_contains($url, 'youtube.com/watch?v=')) {
            $id = explode('watch?v=', $url)[1];
            return "https://www.youtube.com/embed/$id";
        }
        return $url;
    }
}
