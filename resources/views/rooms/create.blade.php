@extends('layouts.admin.master')
@section('content')


<form method="post" action="/rooms">
    {{csrf_field()}}

<div class="form-group row box-body">

        <label for="number" class="col-md-2 col-form-label text-md-right">Room Number</label>

        <div class="col-md-6">
            <input id="number" type="number" class="form-control" name="number">
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

             <div class="form-group row box-body">
        
        <label for="floor_id" class="col-md-2 col-form-label text-md-right">Floor_id</label>

        <div class="col-md-6">
           <select value="_" name="floor_id">

           @foreach($floors as $floor)
                <option>{{$floor->id}}</option>
           @endforeach
           </select>
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