<?php

namespace App\Http\Resources;

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
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'genderText' => $this->getGender(),
            'statusText' => $this->getStatus(),
            'role' => $this->role,
            'gender' => $this->gender,
            'status' => $this->status,
            'cover_photo' => $this->cover_photo ?? '/static/avatar_' . $this->gender . '.png'
        ];
    }
}
