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
<script src="https://js.stripe.com/v2/" type="text/javascript"></script>
<form accept-charset="UTF-8" action="/checkout" class="require-validation"
    data-cc-on-file="false"
    data-stripe-publishable-key="{{ env('STRIPE_PUB_KEY') }}"
    id="payment-form" method="post">
    {{ csrf_field() }}
    <div class='form-row'>
        <div class='col-xs-12 form-group required'>
            <label class='control-label'>Accompany Number</label> <input
                class='form-control' type='text' name="accompany_number">
                <input type="hidden" value="{{$room->id}}" name="id">
        </div>
    </div>
    <div class='form-row'>
        <div class='col-xs-12 form-group card required'>
            <label class='control-label'>Card Number</label> <input
                autocomplete='off' class='form-control card-number' size='20'
                type='text'>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-xs-4 form-group cvc required'>
            <label class='control-label'>CVC</label> <input autocomplete='off'
                class='form-control card-cvc' placeholder='ex. 311' size='4'
                type='text'>
        </div>
        <div class='col-xs-4 form-group expiration required'>
            <label class='control-label'>Expiration</label> <input
                class='form-control card-expiry-month' placeholder='MM' size='2'
                type='text'>
        </div>
        <div class='col-xs-4 form-group expiration required'>
            <label class='control-label'> </label> <input
                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                type='text'>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12'>
            <div class='form-control total btn btn-info'>
                Total: <span class='amount'>{{$room->dollar_price}} $</span>
            </div>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12 form-group'>
            <button class='form-control btn btn-primary submit-button'
                type='submit' style="margin-top: 10px;">Pay »</button>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12 error form-group hide'>
            <div class='alert-danger alert'>Please correct the errors and try
                again.</div>
        </div>
    </div>
</form>

@endsection