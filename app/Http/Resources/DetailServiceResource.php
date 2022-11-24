<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailServiceResource extends JsonResource
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
            'service_id'    => $this->service_id,
            'title'         => $this->title,
            'body'          => $this->body,
            'image'         => asset('storage/detail-service/' . $this->image),
            'created'       => $this->created_at,
            'updated'       => $this->updated_at,
        ];
    }
}
