<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Datatables\Datatables;

use Auth;
use App\User;
use App\Room;

class ClientsController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $clients = Auth::user()->hasRole('admin|manager') ? User::role('client')->get() : 
                    User::role('client')->where('created_by', Auth::user()->id)->get();
        return Datatables::of($clients)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

}
