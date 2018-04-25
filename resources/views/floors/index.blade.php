@extends('layouts.admin.master')
@section('content')


<body>
 <table border="1">
 <thead>
<th> Floor's Name </th>
<th> Floor's Number </th>
<th>Manager's Name</th>
<th> Actions </th>
</thead>
<tbody>
@foreach ($floors as $floor)
<tr> 
    <td>{{$floor->name}}</td>
    <td>{{$floor->floor_num}}</td>
   <td>  hamada </td>
   <!-- if current logged in is Admin -->

    
    <!-- if the manager created that floor -->
    <td> <a href='floors/{{$floor->id}}/edit'> <input  value="edit" class="btn btn-primary"></a> </td>
    <td> <a href='floors/{{$floor->id}}'>  <input  value="Delete" class="btn btn-primary"> </a> </td>

</tr>
@endforeach
</tbody>

</table>
</body>
@endsection