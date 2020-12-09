<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'contract' => [
                'contract_date' => $this->contract_date,
                'contract_expiration' => $this->contract_expiration
            ],
            'address' => [
                'address_id' => $this->address_id,
                'country' => $this->country,
                'city' => $this->city,
                'region' => $this->region,
                'street' => $this->street
            ]
        ];
    }
}
