<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'room_num' => $this->room_num,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'status'=>$this->status,
            'created_by'=>new UserResource($this->user)

        ];
    }
}
