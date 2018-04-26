@extends('reservations.start')

@section('data')
<table class="table">
    <tr class="row">
        <td class="col-md-3">Room Number</td>
        <td class="col-md-3">{{$room->room_num}}</td>
        <td class="col-md-6"></td>
    </tr>
    <tr class="row">
        <td class="col-md-3">Price</td>
        <td class="col-md-3">{{$room->dollar_price}} $</td>
        <td class="col-md-6"></td>
    </tr>
    <tr class="row">
        <td class="col-md-3">Capacity</td>
        <td class="col-md-3">{{$room->capacity}}</td>
        <td class="col-md-6"></td>
    </tr>
    <form method="POST" action="/reservations" >
    {{ csrf_field() }}
    <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
        data-amount="999"
        data-name="Stripe.com"
        data-description="Example charge"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-zip-code="true">
    </script>
        <tr class="row">
            <td class="col-md-3"><label class="text-md-right"> Accompany Number</label></td>
            <td class="col-md-3"><input id="accompany_number" type="text" name="accompany_number"/></td>
            <td class="col-md-3"><input type="submit" value="Reserve" class="btn btn-success"></td>
            <td class="col-md-3"><input type="hidden" value="{{$room->id}}" name="id"></td>
        </tr>
    </form> 
    <tr class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </tr>                              
</table>
@endsection