@extends('reservations.start')

@section('data')
<div class="row col-md-8 ol-md-offset-4 ">
    <table class="table">
        <tr>
            <th>Room Number</th>
            <th>Price</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
        @foreach($rooms as $room)
        <tr>
            <td>{{$room->room_num}}</td>
            <td>{{$room->dollar_price}} $</td>
            <td>{{$room->capacity}}</td>
            <td>
                <form method="get" action="/reservations/{{$room->id}}">
                    <input type="submit" value="Make" class="btn btn-success"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection