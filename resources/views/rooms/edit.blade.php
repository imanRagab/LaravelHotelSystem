@extends('layouts.admin.master')
@section('content')
<form method="post" action="/update/{{$room->room_num}}">
{{csrf_field()}}
Room's Number :- <input type="text" name="room_num" value={{$room->room_num}}>
Room's Capacity :- <input type="number" name="capacity" value={{$room->capacity}}>

<br><br>
<input type="submit" value="Submit" class="btn btn-primary">
</form>
@endsection