<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagsResource extends JsonResource
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
            'id'        => $this->id,
            'type'      => $this->type,
            'name'      => $this->name,
            'created'   => $this->created_at,
            'updated'   => $this->updated_at,
            'deleted'   => $this->deleted_at,
        ];
    }
}
