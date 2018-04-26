<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floor;
use App\Http\Requests\FloorsStoreRequest;
use App\User;
use Illuminate\Support\Facades\DB;

class FloorsController extends Controller
{

    public function index()
    {

        $floors = Floor::all();
        return view('floors.index',[
        'floors' => $floors
        ]);
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
        $floor->save();
    
   return redirect('floors'); 
}

    ////////////////////////////////////////////////////////
    public function edit($id)
    {       
            // $floor = DB::table('floors')->where('floor_num', '=', $floor_num)->get();
            $floor = Floor::find($id);
            $users= User::all();
            return view('floors.edit',[
            'floor'=>$floor,
            'users'=>$users
            ]);
    
        }
        //////////////////////////////////////////////////

        public function update(Request $request,Floor $floor)
        {
           
           
            $new_floor = $request->only(['name', 'floor_num']);
            $floor->update($new_floor);
            
           return redirect('/floors'); 
            
        }






}
