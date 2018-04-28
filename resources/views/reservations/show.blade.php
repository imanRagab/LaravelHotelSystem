@extends('reservations.start')

@section('data')
<div class="row col-md-8 ol-md-offset-4 ">
    <table class="table" id="reservations">
        <thead>
        <tr>
            <th>Accompany number</th>
            <th>Paid Price </th>
            <th>Room Number</th>
        </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">

$(document).ready(function() {

    oTable = $('#reservations').DataTable({

        "processing": true,

        "serverSide": true,

        "ajax": "{{ route('reservations/all') }}",

        "columns": [
            {data: 'accompany_number', name: 'accompany_number'},
            {data: 'paid_price', name: 'paid_price'},
            {data: 'number', name: 'number'},
        ]

    });
  
 
});

</script>
@endsection
