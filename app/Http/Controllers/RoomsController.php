<?php

 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Floor;
use App\User;
use Yajra\Datatables\Datatables;
use App\Http\Requests\RoomsStoreRequest;
use App\Http\Requests\RoomsUpdateRequest;
use Auth;

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

/////////////////////////////////////////

     /////////////////////////////////////////////
     public function create()
     {
         $floors=Floor::All();
         return view('rooms.create',[
            'floors' => $floors
           ]);
     }
/////////////////////////////////////////////////////


public function store(RoomsStoreRequest $request)
{
        $room = new Room;
        $room->number = $request->number;
        $room->capacity=$request->capacity;
        $room->price=$request->price;
        $room->created_by = Auth::user()->id;
        $room->floor_id=$request->floor_id;
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

public function update(RoomsUpdateRequest $request,Room $room)
{
    $new_room = $request->only(['number', 'capacity','price']);
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
        if(Auth::user()->hasRole('admin')){
            return Datatables::of(Room::all())
            ->addColumn('price', function ($room) {
             
                 return $room->dollar_price;
                 
             })
           ->addColumn('Manager_name', function ($room) {
        
                return $room->user[0]->name;
                
            })
            ->addColumn('action', function ($room) {
                
                    $delUrl = "/rooms/" . $room->id;
                    return '<a href="/rooms/'.$room->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <button  onclick=delRoom("' . $delUrl . '") class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax"  > Delete </i> </button>
                  ';
                
        })
       
        ->make(true);
    }elseif(Auth::user()->hasRole('manager')){
        return Datatables::of(Room::all())
            ->addColumn('price', function ($room) {
             
                 return $room->dollar_price;
                 
             })
          
            ->addColumn('action', function ($room) {
                if(Auth::id()==$room->created_by){
                    $delUrl = "/rooms/" . $room->id;
                    return '<a href="/rooms/'.$room->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <button  onclick=delRoom("' . $delUrl . '") class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax"  > Delete </i> </button>
                  ';
                } 
        })
       
        ->make(true);
    }
}
}