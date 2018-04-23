@extends('dashboard')
    @section('content')
        <table class="table">
            <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Country</th>
                <th>Gender</th>
            </tr>
            @foreach($clients as $client)
            <tr>
                <td></td>
                <td>{{$client->name}}</td>
                <td>{{$client->email}}</td>
                <td>{{$client->mobile}}</td>
                <td>{{$client->national_id}}</td>
                <td>{{$client->gender}}</td>
            </tr>
            @endforeach 
        </table> 
        </table>
    @endsection