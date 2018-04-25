@extends('layouts.admin.master')

@section('content')

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit client</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {{-- <form role="form" method="POST" action="/clients/{{$client->id}}">
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
    </form> --}}

    <form role="form" method="POST" action="/clients/{{$client->id}}">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      <div class="form-group row box-body">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $client->name }}" required autofocus>

              @if ($errors->has('name'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row box-body">
          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $client->email }}" required>

              @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class="form-group row box-body">
          <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

          <div class="col-md-6">
              <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $client->mobile }}" required autofocus>

              @if ($errors->has('mobile'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('mobile') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group row box-body">
          <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
          <div class="col-md-2">
              <label for="male" >{{ __('Male') }}</label>
          </div>
          <div class="col-md-1" >
              <input type="radio" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="male" required autofocus {{$client->gender=="male"? 'selected':''}}>
          </div>
          <div class="col-md-2">
              <label for="female" >{{ __('Female') }}</label>
          </div>
          <div class="col-md-1">    
              <input  type="radio" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="female" {{$client->gender=="female"? 'selected':''}}>                               
          </div>  
          <div>
              @if ($errors->has('gender'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('gender') }}</strong>
                  </span>
              @endif
          </div>
      </div> 

      <div class="form-group row box-body">
          <label for="national_id" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

          <div class="col-md-6">
          <select id="national_id" name="national_id"  value="{{ old('national_id') }}" class="form-control{{ $errors->has('national_id') ? ' is-invalid' : '' }}" >
          <option ></option>
              @foreach($countries as $country)
                  <option value="{{$country['calling_code']}}" value="{{ old('national_id')==$country['calling_code'] ? 'selected' : ''}}">{{$country['name']}}</option>
              @endforeach    
          </select>

              @if ($errors->has('mobile'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('national_id') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group row box-body">
          <label for="avatar_image" class="col-md-4 col-form-label text-md-right">{{ __('Avatar_image') }}</label>

          <div class="col-md-6">
              <input id="avatar_image" type="file" class="form-control{{ $errors->has('avatar_image') ? ' is-invalid' : '' }}" name="avatar_image" value="{{ old('avatar_image') }}">

              @if ($errors->has('avatar_image'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('avatar_image') }}</strong>
                  </span>
              @endif
          </div>
      </div>
      <div class="form-group box-footer">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
              </button>
          </div>
      </div>
  </form>

  </div>

@endsection