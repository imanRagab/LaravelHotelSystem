@extends('layouts.admin.master')

@section('content')
   
   @if(!$user->approved_state)
        <div class="row justify-content-center">
            <label class=" col-md-8 col-md-offset-4 col-form-label text-md-right">You should wait until one approved yoy</label>
        </div>
    @else
        <div class="row">
            <div class="col-md-2">
                <form method="get" action="/reservations">
                    <input type="submit" value="Make Reservation​" class="btn btn-primary"/><br/><br/>
                </form>
            </div>  
            <div class="col-md-2">
                <form method="get" action="/reservations/all">
                    <input type="submit" value="​ My Reservations​" class="btn btn-primary"/><br/><br/>
                </form>
            </div>       
        </div> 
        @yield('data')        
   @endif
@endsection