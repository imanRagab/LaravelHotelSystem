<?php

 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\RoomsStoreRequest;
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


     /////////////////////////////////////////////
     public function create()
     {
         return view('rooms.create');
     }
/////////////////////////////////////////////////////


public function store(Request $request)
{
        $room = new Room;
        $room->room_num = $request->room_num;
        $room->capacity=$request->capacity;
        $room->price=$request->price;
        $room->status=0;
        $room->save();

        return redirect('rooms'); 
}

/////////////////////////////////////////////

public function edit($id)
{       
        $room = Room::find($id);
        $users= User::all();
        return view('rooms.edit',[
        'room'=>$room,
        'users'=>$users
        ]);

    }
/////////////////////////////////////

public function update(Request $request,Room $room)
{
    $new_room = $request->only(['room_num', 'capacity','price']);
    $room->update($new_room);
    return redirect('/rooms');     
}


/////////////////////////////////////////
public function destroy(Room $room)
{
    if($room->status == 0){
        $room->delete();
        return "true";
    }
    else
        return "false";
}
/////////////////////////////////////////
public function getData()
    {
        return Datatables::of(Room::all())->make(true);
    }
}