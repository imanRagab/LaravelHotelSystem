<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
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
            'room_num' => $this->number,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'status'=>$this->status,
            'created_by'=>User::findOrFail($this->created_by)->name

        ];
    }
}
