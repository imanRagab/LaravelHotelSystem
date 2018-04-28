<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Auth;

class ManagersController extends Controller
{
    //Display All Managers
    public function index()
    {
       return view('managers.index');
    }

    public function get_all_managers()
    {
        $managers = User::role('manager')->get();
        
     if(Auth::user()->hasRole('admin')){
        return Datatables::of($managers)
        ->addColumn('created_at', function ($manager) {
        
            return $manager->created_date;
            
        })
        ->addColumn('action', function ($manager) {
          return '<a href="/managers/'.$manager->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax" user-id="'.$manager->id.'" > Delete </i> </a>';  
        })->make(true);
    }
        
    }

    //create new receptionist
    public function create()
    {
        return view('managers.create');
    }

    //Store Post in database
     public function store(UserStoreRequest $request)
     {
         if( $request->hasFile('avatar_image')) {
             $image = $request->file('avatar_image');
             $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
             $filename = $imagename. '_'. time() . '.' . $image->getClientOriginalExtension();
             $request->avatar_image->storeAs('public/images',$filename);
             $manager=User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'national_id'=>$request->national_id,
                'avatar_image'=>'storage/images/'.$filename
   
            ]);
         }else{
            $manager=User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'created_by'=>Auth::id(),
                'national_id'=>$request->national_id,
            ]);
         }
         $manager->assignRole('manager');
         return redirect( '/managers'); 
        
     }

    //Edit Receptionist in database
    public function edit($user_id)
    {
  
        $manager = User::findOrFail($user_id);
        return view('managers.edit',[
            'manager' => $manager,   
        ]);
    }

    //update Manager in database
    public function update(UserUpdateRequest $request,  $id)
    {
        $manager = User::findOrFail($id);
         if( $request->hasFile('avatar_image')) {
            if (file_exists(public_path() . '/'.$manager->avatar_image) && $manager->avatar_image != "storage/images/avatar.jpg"){
                unlink(public_path() . '/'.$manager->avatar_image) ;
            }
            
            $image = $request->file('avatar_image');
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $imagename. '_'. time() . '.' . $image->getClientOriginalExtension();
            $request->avatar_image->storeAs('public/images',$filename);
            $manager->update(['avatar_image' => 'storage/images/'.$filename]);
        }

        $manager->fill($request->only(['name','email','national_id']))->save();

        return redirect(route('managers'));
    }

    /**Delete Manager */

public function destroy(Request $request){
    $manager = User::findOrFail($request->userId);
    if (file_exists(public_path() . '/'.$manager->avatar_image)){
        unlink(public_path() . '/'.$manager->avatar_image) ;
    }

  
    $manager->delete();
    
    return response()->json(['response' => "success"]);
}




    
}
