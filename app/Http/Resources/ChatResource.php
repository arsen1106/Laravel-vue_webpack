<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'from_user_id' =>$this->from_user_id,
            'to_user_id' =>$this->to_user_id,
            'fromUser' => $this->fromUser,
            'toUser' => $this->toUser,
            'text' => $this->text,
            'resource' => $this->resource,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
