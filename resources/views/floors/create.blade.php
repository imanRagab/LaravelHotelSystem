@extends('layouts.admin.master')
@section('content')


<form method="post" action="/floors">
{{csrf_field()}}
Floor's  Name :- <input type="text" name="name">


<br>
<input type="submit" value="Submit" class="btn btn-primary">
</form>

@endsection