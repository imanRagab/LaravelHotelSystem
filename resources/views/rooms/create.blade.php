@extends('layouts.admin.master')
@section('content')


<form method="post" action="/rooms">
{{csrf_field()}}
Room's capacity :- <input type="text" name="capacity">
Room's Price :- <input type="text" name="price">

<br>
<input type="submit" value="Submit" class="btn btn-primary">
</form>

@endsection