<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;


use Cache;
use Auth;
use App\User;
use App\Room;
use App\Reservation;

use App\Http\Requests\UpdateClientRequest;


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
        return view('clients.index',['page_title' => "Approved Clients"]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {

        if(!Cache::get('countries')){
            Cache::put('countries', countries(), 1440);
       }

        return view('clients.edit', [
            'client' => $client,
            'countries'=> Cache::get('countries')
            ]);

    }

    public function update(UpdateClientRequest $request, User $client)
    {

        if($request->avatar_image){
            $new_client = $request->all();
            $new_client['avatar_image'] = 'storage/images/' . $request->avatar_image;

            if (file_exists(public_path() . '/'.$client->avatar_image) && $client->avatar_image != "storage/images/avatar.jpg"){
                unlink(public_path() . '/'.$client->avatar_image) ;
            }
                        
            $image = $request->file('avatar_image');
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $imagename. '_'. time() . '.' . $image->getClientOriginalExtension();
            $request->avatar_image->storeAs('public/images',$filename);
        }

        else  $new_client = $request->except('avatar_image');        
        
        $client->update($new_client);

        return redirect('clients/approved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->delete();
        return "true";
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getApprovedData()
    {
        $clients = Auth::user()->hasRole('admin|manager') ? 
                    User::role('client') -> where('approved_state', 1) -> get()
                    : User::role('client') -> select('name', 'email', 'mobile', 'country', 'gender') -> where([
                        ['created_by', Auth::user()->id],
                        ['approved_state', 1]
                    ]) -> get();
        return Datatables::of($clients)->make(true);
    }

    ////////////Manage pending clients////
    
    public function manage(){

        return view('clients.manage',['page_title' => "Manage Clients"]);
    }

    ////////////////////////////////////

    public function getPendingData()
    {
        $clients = User::role('client') -> select('id','name', 'email', 'mobile', 'country', 'gender') -> where('approved_state', 0) -> get();
        return Datatables::of($clients)->make(true);
    }

    //////////Approve Client////////////

    public function approve(User $client){

        $client->approved_state = 1;
        $client->created_by = Auth::user()->id;
        $client->save();

        return "true";
    }

    ////////////////////////////////////

    public function showReservations(){

        return view('clients.reservations', ['page_title' => "Client Reservations"]);

    }

    public function getReservationsData(){

        $reservation = Reservation::query()
            ->select('name', 'room_num', 'accompany_number', 'paid_price')
            ->join('users','reservations.client_id','=','users.id')
            ->join('rooms','reservations.room_id','=','rooms.id')
            ->where('users.created_by', Auth::user()->id)
            ->get();

        return Datatables::of($reservation)->make(true);  
    }
}
