@extends('layouts.admin.master')
@section('content')

{{--
<body>
 <table border="1">
 <thead>
<th>    Room's Number </th>
<th>  Room's capacity </th>
<th> Room's Price</th>
<th> Floor's Name</th>

<th> Actions </th>
</thead>
<tbody>
@foreach ($rooms as $room)
<tr> 
    <td>{{$room->room_num}}</td>
    <td>{{$room->capacity}}</td>
    <!-- //
    price in dollar
    // -->
    <td>{{$room->floor->name}}</td>
    @admin
   <!-- if current logged in is Admin -->
   <td>{{$room->user->Manager_name}}</td>
    
    <!-- if the manager created that floor -->
    <td> <a href='rooms/{{$room->room_num}}/edit'> <input  value="edit" class="btn btn-primary"></a> </td>
    <td> <a href='rooms/{{$room->room_num}}'>  <input  value="Delete" class="btn btn-primary"> </a> </td>

</tr>
@endforeach
</tbody>

</table>
</body> --}}

<table class="table table-bordered" id="rooms-table">
        <thead>
            <tr>
                <th>Number</th>
                <th>Capacity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    @stop

    @push('js')
    <script>
    $(function() {
        $('#rooms-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('rooms.data') !!}',
            columns: [
                { data: 'room_num', name: 'room_num' },
                { data: 'capacity', name: 'capacity' },
                { data: 'price', name: 'price' },
                { "data": null,
            "defaultContent": "<button class='btn btn-info'>Edit</button> <button class='btn btn-danger'>Delete</button>"}
            ]
            
        });
    });
    </script>
    @endpush

