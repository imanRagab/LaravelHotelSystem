<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use App\Http\Resources\RoomResource;
class RoomsController extends Controller
{
    public function index()
    {
        $rooms=Room::with('user')->paginate();
        return RoomResource::collection($rooms);
    }
}
