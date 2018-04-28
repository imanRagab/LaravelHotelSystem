@extends('layouts.admin.master')

@section('content')
   
    <a href="/clients/manage"><button class="btn btn-info">Manage Clients</button></a>
    <a href="/clients/approved"><button class="btn btn-success">Approved Clients</button></a>
    <a href="/clients/reservations"><button class="btn btn-primary">Clients Reservations</button></a>
    <br><br>

      <table class="table table-bordered" id="ApprovedClientsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Country</th>
                <th>Gender</th>
                @role('admin|manager')
                <th>Action</th>
                @endrole
            </tr>
        </thead>
    </table>

    @stop

    @push('js')
    <script>
    $(function() {
        $('#ApprovedClientsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('approvedClients.data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'mobile', name: 'mobile' },
                { data: 'country', name: 'country' },
                { data: 'gender', name: 'gender' },
                @role('admin|manager')
                {
                    data: null,
                    sortable: false,
                    render: function (client) { 
                        editUrl = "/clients/" + client.id + "/edit";
                        delUrl = "/clients/" + client.id;
                        return '<a href=' + editUrl + ' class="btn btn-info">' + 'Edit' + '</a>'
                        + ' <button onclick=del("' + delUrl + '") ' + 'class="btn btn-danger">' + 'Delete' + '</button>'; 
                    }
                }
            @endrole
        ]
        });   
    });
    </script>
    @endpush
