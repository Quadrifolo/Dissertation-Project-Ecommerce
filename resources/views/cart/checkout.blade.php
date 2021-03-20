@extends('layouts.app')



<script>
function SetBilling(checked) {
	if (checked) {
        document.getElementById('billing_address').style.display="none";
        document.getElementById('billing_address').value = ''; 
	} else {
        document.getElementById('deliveryaddres').style.display="block";
		document.getElementById('deliver_firstname').value = document.getElementById('firstname').value; 
	}
}
    </script>

@section('content')

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<h2> {{ __('Shipping Information') }} </h2>





<form action="{{route('orders.store')}}" method="post">
    @csrf

    <div class="form-group">
        <label for="">{{ __('E-mail Address')}}</label>
        <input type="text" name="email_address" id="" class="form-control">

        <br> 
        <label for="">{{ __('Full Name')}}</label>
        <input type="text" name="shipping_fullname" id="" class="form-control">
    

        <br> 
        <label for=""> {{ __('County')}}</label>
        <input type="text" name="shipping_county" id="" class="form-control">
    

        <br> 
        <label for="">{{ __('City')}}</label>
        <input type="text" name="shipping_city" id="" class="form-control">
    

        <br>
        <label for="">{{ __('Postcode') }}</label>
        <input type="text" pattern= "^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$" name="shipping_postcode" id="" class="form-control">
    

        <br> 
        <label for="">{{ __('Full Address') }}</label>
        <input type="text" name="shipping_address" id="" class="form-control">
    

        <br> 
        <label for=""> {{ __('Mobile') }}</label>
        <input type="text" pattern = "^(?:\d\s?){11}$" name="shipping_phone" id="" class="form-control">

    </div>

    <br> 
    <br>

    <p id="shiptobilling" class="form-row">
        Same as Shipping <input type="checkbox" onclick="SetBilling(this.checked);" checked="checked" /> 
      </p>



    <h2> {{ __('Billing Information') }} </h2>

    
    <div class="form-group1">
        <label for="">{{ __('Full Name')}}</label>
        <input type="text" name="billing_fullname" id="" class="form-control">
    
        <br>
    
        <label for=""> {{ __('County')}}</label>
        <input type="text" name="billing_county" id="" class="form-control">
 
        <br>

        <label for="">{{ __('City')}}</label>
        <input type="text" name="billing_city" id="" class="form-control">
  
        <br>

        <label for="">{{ __('Postcode') }}</label>
        <input type="text" pattern= "^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$" name="billing_postcode" id="" class="form-control">
        
        <br>

        <label for="">{{ __('Full Address') }}</label>
        <input type="text" name="billing_address" id="" class="form-control">

        <br>

        <label for=""> {{ __('Mobile') }}</label>
        <input type="text" pattern = "^(?:\d\s?){11}$" name="billing_phone" id="" class="form-control">

    </div>

    <input type="checkbox" name="checkbox" id="option"  ><label for="option"><span></span> <p>Agree To  <a href="#">Terms & Conditions</a></p></label>

    
    
    

  
    <h4> {{ __('Payment Option') }}</h4>

    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="cash_on_delivery">
            {{ __('Cash on Delivery') }} 

        </label>

    </div>

    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="paypal">
            {{ __('Paypal') }}

        </label>

    </div>


    <button type="submit" class="btn btn-primary mt-3"> {{ __('Place Order') }}</button>


    
</form>


@endsection