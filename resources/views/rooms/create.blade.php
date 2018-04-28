@extends('layouts.admin.master')
@section('content')


<form method="post" action="/rooms">
    {{csrf_field()}}

<div class="form-group row box-body">

        <label for="room_num" class="col-md-2 col-form-label text-md-right">Room Number</label>

        <div class="col-md-6">
            <input id="room_num" type="number" class="form-control" name="room_num">
        </div>
    </div>

    <div class="form-group row box-body">
        
            <label for="capacity" class="col-md-2 col-form-label text-md-right">Capacity</label>
    
            <div class="col-md-6">
                <input id="capacity" type="number" class="form-control" name="capacity">
            </div>
        </div>

        <div class="form-group row box-body">
        
                <label for="price" class="col-md-2 col-form-label text-md-right">Price</label>
        
                <div class="col-md-6">
                    <input id="price" type="number" class="form-control" name="price">
                </div>
            </div>

        <div class="form-group">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
</form>

@endsection