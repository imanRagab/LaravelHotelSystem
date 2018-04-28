<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Yajra\Datatables\Datatables;

use Auth;
use App\User;
use App\Room;
use App\Reservation;
use App\Notifications\greetClient;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\Builder;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {

        return view('clients.edit', ['client' => $client]);

    }

    public function update(Request $request, User $client)
    {
        $new_client = $request->all();;
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
                    : User::role('client') -> where([
                        ['created_by', Auth::user()->id],
                        ['approved_state', 1]
                    ]) -> get();
        return Datatables::of($clients)->make(true);
    }

    ////////////Manage pending clients////
    
    public function manage(){

        return view('clients.manage');
    }

    ////////////////////////////////////

    public function getPendingData()
    {
        $clients = User::role('client') -> where('approved_state', 0) -> get();
        return Datatables::of($clients)->make(true);
    }

    //////////Approve Client////////////

    public function approve(User $client){

        $client->approved_state = 1;
        $client->save();
        $when = now()->addSeconds(10);
        $client->notify((new greetClient)->delay($when));
        return "true";
    }

    ////////////////////////////////////

    public function showReservations(){

        return view('clients.reservations');

    }

    public function getReservationsData(){

        return Datatables::of(Reservation::all())->make(true);
        
    }

    public function editProfile($id)
    {
        $user=User::findOrFail($id);
        return view('clients.editProfile',['user'=>$user]);
    }

    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('clients.showProfile',['user'=>$user]);
    }
    public function updateProfile($id,UserUpdateRequest  $request)
    {
        $user=User::findOrFail($id);
        if( $request->hasFile('avatar_image')) {
            if (file_exists(public_path() . '/'.$user->avatar_image) && $user->avatar_image != "storage/images/avatar.jpg"){
                unlink(public_path() . '/'.$user->avatar_image) ;
            }
            
            $image = $request->file('avatar_image');
            $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $imagename. '_'. time() . '.' . $image->getClientOriginalExtension();
            $request->avatar_image->storeAs('public/images',$filename);
            $user->update(['avatar_image' => 'storage/images/'.$filename]);
        }

        $user->update(['name'=>$request->name,'email'=>$request->email,'mobile'=>$request->mobile,'national_id'=>$request->national_id]);
        $validated = $request-> validated();
        return redirect(route('users.show',['user'=>$id]));
    
    }
    public function signOut()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
