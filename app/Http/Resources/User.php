<?php

namespace App\Http\Resources;

use App\User as AppUser;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'status_id' => $this->status_id,
            'role_id' => $this->role_id,
            'avatar' => $this->avatar ? url($this->avatar->path) : '',
            'created_at' => $this->created_at
        ];
    }
}
