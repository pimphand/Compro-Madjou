<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'type'  => $this->type,
            'user_id'   => $this->user_id,
            'amount'    => $this->amount,
            'code_unique'   => $this->code_unique,
            'invoice_id'    => $this->invoice_id,
        ];
    }
}
