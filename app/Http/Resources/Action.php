<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Action extends JsonResource
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
            'name' => $this->title,
            'company_id' => $this->company_id,
            'detail' => $this->status,
            'color' => $this->color,
            'start' => $this->scheduleFrom,
            'end' => $this->scheduleTo,
            'place' => $this->place
        ];
    }
}
