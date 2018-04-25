@extends('layouts.admin.master')
@section('content')
<form method="post" action="/update/{{$floor->id}}">
{{csrf_field()}}

Floor's Name :- <input type="text" name="name" value="{{$floor->name}}">
<br><br>
<input type="submit" value="Submit" class="btn btn-primary">
</form>
@endsection