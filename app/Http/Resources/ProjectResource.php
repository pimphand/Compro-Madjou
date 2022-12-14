<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'id'                => $this->id,
            'project_type'      => new ProjectTypeResource($this->getType),
            'programming'       => $this->programming,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'body'              => $this->body,
            'url'               => $this->url,
            'image'             => $this->image,
            'location'          => $this->location,
            'lang'              => $this->lang,
            'created'           => $this->created_at,
            'updated'           => $this->updated_at,
        ];
    }
}
