<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'    => $this->id,
            'name'  => $this->name,
            'image' => $this->image,
            'url'   => $this->url,
            'key'   => $this->key,
            'price'     => $this->price,
            'created'   => $this->created_at,
            'updated'   => $this->updated_at,
            'create'    => $this->create,
            'update'    => $this->update,
            'read'      => $this->read,
            'delete'    => $this->delete,
        ];
    }
}
