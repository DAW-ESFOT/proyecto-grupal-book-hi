<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Chat extends JsonResource
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
            'user1' => "/api/users/" .$this->user_id1,
            'user2' => "/api/users/" .$this->user_id2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
