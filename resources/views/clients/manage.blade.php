@extends('layouts.admin.master')

@section('content')
   
     <a href="/clients/manage"><button class="btn btn-info">Manage Clients</button></a>
    <a href="/clients/approved"><button class="btn btn-success">My Approved Clients</button></a>
    <a href="/clients/reservations"><button class="btn btn-primary">Clients Reservations</button></a>
    <br><br>

      <table class="table table-bordered" id="pendingClientsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Country</th>
                <th>Gender</th>
                @role('admin|manager|receptionist')
                <th>Action</th>
                @endrole
            </tr>
        </thead>
    </table>

    @stop

    @push('js')
    <script>
    $(function() {
        $('#pendingClientsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('pendingClients.data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'mobile', name: 'mobile' },
                { data: 'country', name: 'country' },
                { data: 'gender', name: 'gender' },
                @role('admin|manager|receptionist')
                {
                    data: null,
                    sortable: false,
                    render: function (client) { 
                        return ' <button onclick=approve(' + client.id + ') ' + 'class="btn btn-success">' + 'Approve' + '</button>'; 
                    }
                }
            @endrole
            ]
        });
    });
    </script>
    @endpush
