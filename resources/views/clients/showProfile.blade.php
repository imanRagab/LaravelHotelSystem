@extends('layouts.admin.master')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Info Page   <a href="{{route('editProfile',['user'=>Auth::user()])}}"><button  type="button" class="btn btn-info"  style="position:absolute;right:1%;">Edit Profile</button></a></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
          </div>  

@endsection