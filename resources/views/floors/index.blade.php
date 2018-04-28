@extends('layouts.admin.master')
@section('content')

<a href="/floors/create"><button class="btn btn-success">Create Floor</button></a>
<br><br>
<table class="table table-bordered" id="floors-table">
        <thead>
            <tr>
                <th> Floor's Name</th>
                <th>Floor's Number</th>
                @role('admin')
                <th>Created By</th>
                @endrole
                
                <th>Action</th>
                
            </tr>
        </thead>
    </table>

    @stop

    @push('js')
    <script>

    HTMLElement.prototype.delFloor = function(delUrl){
        var resp = confirm("Are you sure you want to delete this room?");
        if (resp == true) {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax(
            {
                url: delUrl,
                type: 'delete',
                dataType: "JSON",
                data: "{}",
                success: function (response)
                {
                    if(!response){
                        alert("Floor rooms are not empty it can't be deleted!");
                    }
                    else{
                        alert("Floor deleted successfully");
                        window.location.href = "/floors";
                    }  
                    
                }                
            });
        }
    }    
    $(function() {
        $('#floors-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('floors.data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'number', name: 'number' },
               
                @role('admin')
                {data: 'Manger_name', name: 'Manger_name'},
                @endrole
                {data: 'action', name: 'action'},
              

        ]
            
        });
    });
    </script>
    @endpush
