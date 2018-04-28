@extends('layouts.admin.master')
@section('content')


<form method="post" action="/floors">
{{csrf_field()}}

<div class="form-group row box-body">
        
        <label for="name" class="col-md-2 col-form-label text-md-right">Floor Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name">
        </div>
    </div>

<div class="form-group">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </div>
    </div>

</form>

@endsection