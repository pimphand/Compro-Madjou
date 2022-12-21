<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'id'            => $this->id,
            'user_id'       => $this->users_id,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'tags'          => $this->tags,
            'body'          => $this->body,
            'image'         => $this->image,
            'detail_service' => DetailServiceResource::collection($this->whenLoaded('detail'))
        ];
    }
}
