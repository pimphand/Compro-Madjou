<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BlogResource extends JsonResource
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
            'id'                    => $this->id,
            'category_name'        => new CategoryBlogResource($this->getCategories),
            'title'                 => $this->title,
            'slug'                  => $this->slug,
            'body'                  => $this->body,
            'image'                 => $this->image,
            'tags'                  => $this->tags,
            'lang'                  => $this->lang,
            'author'                => Auth::user(),
            'created'               => $this->created_at,
        ];
    }
}
