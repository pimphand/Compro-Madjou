<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'category_id'   => $this->category_team_id,
            'name'          => $this->name,
            'image'         => $this->image,
            'position'      => $this->position,
            'created'       => $this->created_at,
            'update'        => $this->update_at,
            'delete'        => $this->delete_at,
        ];
    }
}
