@extends('layouts.admin.master')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit client</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/clients/{{$client->id}}" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      <div class="form-group row box-body">
          <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $client->name }}" required autofocus>
          </div>
      </div>

      <div class="form-group row box-body">
          <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $client->email }}" required>
          </div>
      </div>

      <div class="form-group row box-body">
          <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>

          <div class="col-md-6">
              <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $client->mobile }}" required autofocus>
          </div>
      </div>
      <div class="form-group row box-body">
          <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
          <div class="col-md-2">
              <label for="male" >Male</label>
          </div>
          <div class="col-md-1" >
              <input type="radio" class=" {{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="male" required autofocus {{$client->gender=="male"? 'checked':''}}>
          </div>
          <div class="col-md-2">
              <label for="female" >Female</label>
          </div>
          <div class="col-md-1">    
              <input  type="radio" class="{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="female" {{$client->gender=="female"? 'checked':''}}>                               
          </div>  
          <div>
          </div>
      </div> 

      <div class="form-group row box-body">
          <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

          <div class="col-md-6">
          <select id="country" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" >
          <option ></option>
              @foreach($countries as $country)
                  <option {{ $client->country==$country['name'] ? 'selected' : ''}}>{{$country['name']}}</option>
              @endforeach    
          </select>
          </div>
      </div>

      <div class="form-group row box-body">
        <label for="national_id" class="col-md-4 col-form-label text-md-right">National Id</label>

        <div class="col-md-6">
        <input id="national_id" name="national_id"  value="{{ $client->national_id }}" class="form-control{{ $errors->has('national_id') ? ' is-invalid' : '' }}" >
    </div>
      </div>
      <div class="form-group row box-body">
          <label for="avatar_image" class="col-md-4 col-form-label text-md-right">Avatar Image</label>

          <div class="col-md-6">
              <input id="avatar_image" type="file" class="{{ $errors->has('avatar_image') ? ' is-invalid' : '' }}" name="avatar_image">
          </div>
      </div>
      <div class="form-group box-footer">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  Save
              </button>
          </div>
      </div>
  </form>

  </div>

@endsection