
@extends('layouts.admin.master')

@section('content')
<br/>
<a href="/receptionists/create"><button id="new" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create Receptionist</button></a>
 <br/>
<table id="users" class="table table-hover table-condensed" style="width:100%">

    <thead>

        <tr>

            <th>ID</th>

            <th>Name</th>

            <th>Email</th>

            <th>Created_at</th>
            @role('admin')
            <th>Created_by</th>
            @endrole
            <th>Actions</th>
        </tr>
    </thead>

  </table>

</div>


<script type="text/javascript">

$(document).ready(function() {

    oTable = $('#users').DataTable({

        "processing": true,

        "serverSide": true,

        "ajax": "{{ route('receptionists.get_all_receptionists') }}",

        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            @role('admin')
            {data: 'Manger_name', name: 'Manger_name'},
            @endrole
            {data: 'action', name: 'action', orderable: false, searchable: false}

            

        ]

    });
  
 
});

</script>
@endsection