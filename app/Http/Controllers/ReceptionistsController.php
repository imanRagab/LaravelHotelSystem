<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;
use Auth;

class ReceptionistsController extends Controller
{
    //Display All Receptionists
    public function index()
    {
       return view('receptionists.index');
    }

    public function get_all_receptionists()
    {
        $receptionists = User::role('receptionist')->get();
        
     if(Auth::user()->hasRole('admin')){
        return Datatables::of($receptionists)
        ->addColumn('created_at', function ($receptionist) {
        
            return $receptionist->created_date;
            
        })
        ->addColumn('Manger_name', function ($receptionist) {
        
            return $receptionist->user[0]->name;
            
        })
        ->addColumn('action', function ($receptionist) {
        if($receptionist->isNotBanned()){
            return '<a href="/receptionists/'.$receptionist->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax" user-id="'.$receptionist->id.'" > Delete </i> </a>
            <a   class="btn btn-xs btn-info" ><i class="fa fa-ban banOrunban" user-id="'.$receptionist->id.'" > Ban </i></a>';
        }else{
            return '<a href="/receptionists/'.$receptionist->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="#"  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax" user-id="'.$receptionist->id.'"> Delete </i> </a>
            <a   class="btn btn-xs btn-info" ><i class="fa fa-ban banOrunban" user-id="'.$receptionist->id.'" > UnBan </i></a>';
        }
           
            
        })->make(true);
     }elseif(Auth::user()->hasRole('manager')){
        return Datatables::of($receptionists)
        ->addColumn('created_at', function ($receptionist) {
        
            return $receptionist->created_date;
            
        })
        ->addColumn('action', function ($receptionist) {
            if (Auth::id()==$receptionist->created_by && $receptionist->isNotBanned()){
            return '<a href="/receptionists/'.$receptionist->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax" user-id="'.$receptionist->id.'"> Delete </i> </a>
            <a  class="btn btn-xs btn-info" ><i class="fa fa-ban banOrunban" user-id="'.$receptionist->id.'" > Ban </i></a>';
            }else{
                return '<a href="/receptionists/'.$receptionist->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a href="#"  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax" user-id="'.$receptionist->id.'"> Delete </i> </a>
                <a class="btn btn-xs btn-info" ><i class="fa fa-ban banOrunban" user-id="'.$receptionist->id.'" > UnBan </i></a>'; 
            }
        })->make(true);
     }
        
    }


    //create new receptionist
    public function create()
    {
        return view('receptionists.create');
    }

     //Store Post in database
     public function store(Request $request)
     {
         if( $request->hasFile('image')) {
             $image = $request->file('image');
             $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
             $filename = $imagename. '_'. time() . '.' . $image->getClientOriginalExtension();
             $request->image->storeAs('public/images',$filename);
             $receptionist=User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'created_by'=>Auth::id(),
                'national_id'=>$request->number,
                'avatar_image'=>'storage/images/'.$filename
   
            ]);
         }else{
            $receptionist=User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'created_by'=>Auth::id(),
                'national_id'=>$request->number,
                
   
            ]);
         }
         $receptionist->assignRole('receptionist');
         return redirect(route('receptionists')); 
     }

     //Edit Receptionist in database
    public function edit($user_id)
    {
  
        $receptionist = User::findOrFail($user_id);
        return view('receptionists.edit',[
            'receptionist' => $receptionist,   
        ]);
    }
    //update Receptionist in database
    public function update(Request $request,  $id)
    {
        $receptionist = User::findOrFail($id);
         if( $request->hasFile('image')) {
            if (file_exists(public_path() . '/'.$receptionist->avatar_image)){
                unlink(public_path() . '/'.$receptionist->avatar_image) ;
            }
          
            $image = $request->file('image');
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $imagename. '_'. time() . '.' . $image->getClientOriginalExtension();
            $request->image->storeAs('public/images',$filename);
            $receptionist->update(['avatar_image' => 'storage/images/'.$filename]);
        }

        $receptionist->fill($request->only(['name','email','national_id']))->save();

        return redirect(route('receptionists'));
    }

/** Ban Or UnBan Receptionist */
    public function banOrunban(Request $request){
        $receptionist = User::findOrFail($request->userId);
        if($receptionist->isBanned()){
            $receptionist->unban();
        }else{
            $receptionist->ban();
        }
        return response()->json(['response' => "success"]);
    }

/**Delete Receptionist */

public function destroy(Request $request){
    $receptionist = User::findOrFail($request->userId);
    if (file_exists(public_path() . '/'.$receptionist->avatar_image)){
        unlink(public_path() . '/'.$receptionist->avatar_image) ;
    }

  
    $receptionist->delete();
    
    return response()->json(['response' => "success"]);
}

    


}
