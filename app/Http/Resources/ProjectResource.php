<?php

namespace App\Http\Resources;

use App\Models\ProgramingLanguage;
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
            'programing'        => new ProgramingLanguage($this->programing),
            'title'             => $this->title,
            'slug'              => $this->slug,
            'body'              => $this->body,
            'client_about'      => $this->client_about,
            'url'               => $this->url,
            'image'             => $this->image,
            'location'          => $this->location,
            'lang'              => $this->lang,
            'year'              => $this->years,
            'price'             => $this->price,
            'logo'              => asset('storage/project-logo/' . $this->logo),
            'gallery'           => ProjectGalleryResource::collection($this->gallery),
            'development'       => ProjectDevelopmentResource::collection($this->development),
        ];
    }
}
