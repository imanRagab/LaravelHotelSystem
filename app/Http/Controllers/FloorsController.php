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
        $floor->number= rand(1,9999);
        $floor->created_by = Auth::user()->id;
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
        $new_floor = $request->only(['name', 'number']);
        $floor->update($new_floor);
        
        return redirect('/floors');         
    }
/////////////////////////////////////////////

    public function destroy(Floor $floor)
    {
       
        if($rooms = $floor->rooms){
       
          foreach($rooms as $room){
              if($room->status==1)
                  return "false";
          }
        }
    
        $floor->delete();
        return "true";
    }
///////////////////////////////////

    public function getData()
    {
       
        if(Auth::user()->hasRole('admin')){
            return Datatables::of(Floor::all())
         
            ->addColumn('Manger_name', function ($floor) {
            
                return $floor->user[0]->name;
                
            })
            
            ->addColumn('action', function ($floor) {
                $delUrl = "/floors/" . $floor->id;
                return '<a href="/floors/'.$floor->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <button  onclick=delFloor("' . $delUrl . '") class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax"  > Delete </i> </button>
          ';
                     })
        ->make(true);
    }elseif(Auth::user()->hasRole('manager')){
        return Datatables::of(Floor::all())
         
        ->addColumn('Manger_name', function ($floor) {
        
            return $floor->user[0]->name;
            
        })
        ->addColumn('action', function ($floor) {
            if(Auth::id()==$floor->created_by){
                $delUrl = "/floors/" . $floor->id;
                return '<a href="/floors/'.$floor->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button  onclick=delFloor("' . $delUrl . '") class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax"  > Delete </i> </button>
              ';
            }
         
                 })
    ->make(true); 
    }
    }
}