@extends('layouts.admin.master')

@section('content')
   
     <a href="/clients/manage"><button class="btn btn-info">Manage Clients</button></a>
    <a href="/clients/approved"><button class="btn btn-success">My Approved Clients</button></a>
    <a href="/clients/reservations"><button class="btn btn-primary">Clients Reservations</button></a>
    <br><br>

      <table class="table table-bordered" id="clientsReservationsTable">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Accompany Number</th>
                <th>Room Number</th>
                <th>Paid Price</th>
            </tr>
        </thead>
    </table>

    @stop

    @push('js')
    <script>
    $(function() {
        $('#clientsReservationsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('clientsReservations.data') !!}',
            columns: [
                { data: 'client', name: 'client' },
                { data: 'accompany_number', name: 'accompany_number' },
                { data: 'room', name: 'room' },
                { data: 'paid_price', name: 'paid_price' }
            ]
        });        
    });
    </script>
    @endpush
