@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>Checkout</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label>Checkout</h2>
	</div>
</div>

<div class="check-out" style="padding:0px;">
    
    
    <div class="four">
        <h3 style="font-size:3em;">Purchase Successful</h3>
        <p style="padding:10px;"></br>
            Thank you for shopping at 8848 Supplies.</br> 
            We have sent you an email confirming the payment and details of your order.
        <br/><br/>
            Kind regards<br/>
            8848 Supplies
        </p>
        

        <a href="/index" class="hvr-skew-backward">Back To Home</a>
    </div>

   
</div>


@endsection