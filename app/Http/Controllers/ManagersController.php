<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
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
        ->addColumn('action', function ($manager) {
          return '<a href="/managers'.$manager->id.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a  class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax" user-id="'.$manager->id.'" > Delete </i> </a>';  
        })->make(true);
    }
        
    }
    
}
