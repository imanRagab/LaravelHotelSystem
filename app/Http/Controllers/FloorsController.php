<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floor;
use App\Http\Requests\FloorsStoreRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Auth;

class FloorsController extends Controller
{

    public function index()
    {
        return view('floors.index');
    }
    ////////////////////////////////////////////

    public function create()
    {

       return view('floors.create');
    }
///////////////////////////////////////////////////

public function store(FloorsStoreRequest $request)
{
        $floor = new Floor;

        $floor->name = $request->name;
        $floor->floor_num = rand(1,9999);
        $floor->manager_id = Auth::user()->id;
        $floor->save();
    
        return redirect('floors'); 
}

    ////////////////////////////////////////////////////////
    public function edit($id)
    {       
        $floor = Floor::find($id);
        return view('floors.edit',[
        'floor'=>$floor,
        ]);
    
    }
 //////////////////////////////////////////////////

    public function update(Request $request,Floor $floor)
    {
        $new_floor = $request->only(['name', 'floor_num']);
        $floor->update($new_floor);
        
        return redirect('/floors');         
    }
/////////////////////////////////////////////

    public function destroy(Floor $floor)
    {
        $rooms = $floor->rooms;
        foreach($rooms as $room){
            if($room->status==1)
                return "false";
        }
        $floor->delete();
        return "true";
    }
///////////////////////////////////

    public function getData()
    {
        return Datatables::of(Floor::all())->make(true);
    }
}