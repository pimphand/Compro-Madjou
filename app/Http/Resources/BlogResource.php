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
            'blog_category_id'      => $this->blog_category_id,
            'title'                 => $this->title,
            'slug'                  => $this->slug,
            'body'                  => $this->body,
            'image'                 => $this->image,
            'tags'                  => $this->tags,
            'author'                => Auth::user(),
            'created'               => $this->created_at,
        ];
    }
}
