<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeRegistrationResource extends JsonResource
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
            'career_id'     => $this->career_id,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'province_code' => $this->province_code,
            'city_code'     => $this->city_code,
            'district_code' => $this->district_code,
            'village_code'  => $this->village_code,
            'created'       => $this->created_at,
            'updated'       => $this->updated_at,
        ];
    }
}
