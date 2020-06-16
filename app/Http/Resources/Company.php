<?php

namespace App\Http\Resources;

use App\Company as AppCompany;
use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
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
            'address' => $this->address,
            'logo' => $this->logo ? url($this->logo->path) : '',
            'created_at' => $this->created_at
        ];
    }
}
