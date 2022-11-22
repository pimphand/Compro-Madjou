<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'code'  => $this->code,
            'name'  => $this->name,
            'body'  => $this->body,
            'image' => $this->image,
            'lang'  => $this->lang,
            'created'   => $this->created_at
        ];
    }
}
