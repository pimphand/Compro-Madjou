<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventRegisterResource extends JsonResource
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
            'event_id'      => $this->getEvent,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'agency'        => $this->agency,
            'created'       => $this->created_at,
        ];
    }
}
