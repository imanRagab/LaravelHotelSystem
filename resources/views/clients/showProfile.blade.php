@extends('layouts.admin.master')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Info Page  <a href="{{route('editProfile',['user'=>$user->id])}}"><button  type="button" class="btn btn-info"  style="position:absolute;right:1%;">Edit Profile</button></a></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName"  type="text" name="name" value="{{$user->name}}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input class="form-control" id="exampleInputEmail1" type="email" name="email" value="{{$user->email}}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputNationalID">Mobile</label>
                  <input class="form-control" id="exampleInputMobile" pattern="[0-9]*" type="text" name="mobile" value="{{$user->mobile}}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputNationalID">National ID</label>
                  <input class="form-control" id="exampleInputNationalID" pattern="[0-9]*" type="text" name="national_id" value="{{$user->national_id}}" disabled>
                </div>
                <div class="form-group">
                <label>Profile Image</label>
                <br/>
                <img src="{{ asset($user->avatar_image) }}" width="100" heigth="100"/>
                <br/>
                </div>
                
              </div>
              <!-- /.box-body -->
          </div>  

@endsection