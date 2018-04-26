@extends('reservations.start')

@section('data')
<div class="row col-md-8 ol-md-offset-4 ">
    <table class="table">
        <tr>
            <th>Room Number</th>
            <th>Paid Price </th>
            <th>Accompany number</th>
        </tr>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{$reservation->room->room_num}}</td>
            <td>{{$reservation->dollar_price}} $</td>
            <td>{{$reservation->accompany_number}}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
