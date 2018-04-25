<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Yajra\Datatables\Datatables;

class RoomsController extends Controller
{
    public function index()
    {
        return view('rooms.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of(Room::all())->make(true);
    }
}
