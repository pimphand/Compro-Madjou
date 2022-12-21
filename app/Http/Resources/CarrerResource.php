<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarrerResource extends JsonResource
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
            'name'                  => $this->name,
            'body'                  => $this->body,
            'location'              => $this->location,
            'department'            => $this->department,
            'minimum_experience'    => $this->minimum_experience,
            'employment_type'       => $this->employment_type,
        ];
    }
}
