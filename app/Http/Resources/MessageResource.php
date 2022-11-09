<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'email'     => $this->email,
            'company'   => $this->company,
            'phone'     => $this->phone,
            'text'      => $this->text,
            'ip'        => $this->ip,
            'country'   => $this->country,
            'requirment'    => $this->requirment,
            'from'          => $this->from,
        ];
    }
}
