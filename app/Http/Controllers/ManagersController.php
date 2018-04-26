<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Spatie\Permission\Traits\HasRoles;
class ManagersController extends Controller
{
    use HasRoles;
    public function index()
    {
        $managers = User::role('manager')->get();
        return view('managers.index',['managers'=>$managers]);
    }


    public function edit($id)
    {
        $manager_edit=User::findOrFail($id);
        return view('managers.edit',['manager' => $manager_edit]);
    }
    public function update($id,$request)
    {

        $manager=User::where('id', $id);
        $post->update();//to be edited
        return redirect(route('managers.index')); 
    }
    public function destroy($id)
    {
       
        User::find($id)->delete();
        return ["status"=>"true"];
    }
}
