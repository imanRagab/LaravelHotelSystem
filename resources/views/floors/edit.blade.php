@extends('layouts.admin.master')
@section('content')
<form role="form" method="POST" action="/floors/{{$floor->id}}">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group row box-body">
        
            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>
    
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value={{$floor->name}}>
            </div>
        </div>

    <div class="form-group">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
@endsection