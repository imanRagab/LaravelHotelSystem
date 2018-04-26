
@extends('layouts.admin.master')

@section('content')
<br/>
<br/>
<a href="/managers/create"><button id="new" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create Manager</button></a>
 <br/>
 <br/>
<table id="users" class="table table-hover table-condensed" style="width:100%">

    <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created_at</th>
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

        "ajax": "{{ route('managers.get_all_managers') }}",

        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ]

    });
  
 
});

</script>
@endsection