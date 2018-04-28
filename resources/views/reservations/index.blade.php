@extends('reservations.start')

@section('data')
<div class="row col-md-8 ol-md-offset-4 ">
    <table class="table" id="available_room">
        <thead>
        <tr>
            <th>Room Number</th>
            <th>Capacity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        </thead>
    </table>
</div>

@stop

@push('js')
<script type="text/javascript">

$(document).ready(function() {

    oTable = $('#available_room').DataTable({

        "processing": true,

        "serverSide": true,

        "ajax": "{{ route('availablerooms') }}",

        "columns": [
            {data: 'number', name: 'number'},
            {data: 'capacity', name: 'capacity'},
            {data: 'paid_price', name: 'paid_price'},
            {data: 'action', name: 'action'},
        ]

    });
  
 
});

</script>
@endpush