@extends('layouts.admin.master')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit client</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/clients/{{$client->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
      <div class="box-body">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" value="{{$client->name}}" name="name">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control"  value="{{$client->email}}" name="email">
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>

@endsection