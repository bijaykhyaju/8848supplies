@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>Detail Confirmation</h1>
		<em></em>
		<h2>
            <a href="{{url('/index')}}">Home</a>
            <label>/</label>
            <a href="{{url('/cart')}}">Cart</a>
            <label>/</label>
            <a href="{{url('/correspondence-detail')}}">Correspondence</a>
            <label>/</label>
            <a href="{{url('/order-summary')}}">Order Summary</a>
            <label>/</label>
            Detail Confirmation
        </h2>
	</div>
</div>



<div class="container mar-bottom">
    <div class="page">
    @isset($failure_title)
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="opacity:1;">
        <strong>{{$failure_title}}</strong> {{$failure_description}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endisset  
        <?php
            $bFirstName = $detailRow->billing_first_name;
            $bLastName = $detailRow->billing_last_name;
            $bAddress1 = $detailRow->billing_address_1;
            $bAddress2 = $detailRow->billing_address_2;
            $bCityTown = $detailRow->billing_town;
            $bState = $detailRow->billing_state;
            $bPostcode = $detailRow->billing_postcode;
            $bCountry = $detailRow->billing_country;
            $bEmail = $detailRow->billing_email;
            $bPhone = $detailRow->billing_phone;
            $sFirstName = $detailRow->shipping_first_name;
            $sLastName = $detailRow->shipping_last_name;
            $sAddress1 = $detailRow->shipping_address_1;
            $sAddress2 = $detailRow->shipping_address_2;
            $sCityTown = $detailRow->shipping_town;
            $sState = $detailRow->shipping_state;
            $sPostcode = $detailRow->shipping_postcode;
            $sCountry = $detailRow->shipping_country;
            $sEmail = $detailRow->shipping_email;
            $sPhone = $detailRow->shipping_phone;
        ?>
        
        <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Billing Detail</h3>
            </div>
            <div class="panel-body">
              <p>{{$bFirstName." ".$bLastName}}</p>
              <p>{{$bAddress1}}</p>
              <p>{{$bAddress2}}</p>
              <p>{{$bCityTown}}</p>
              <p>{{$bState}}</p>
              <p>{{$bPostcode}}</p>
              <p>{{$bCountry}}</p>
              <p>{{$bEmail}}</p>
              <p>{{$bPhone}}</p>

            </div>
            
          </div>
          <a href="{{url('/correspondence-detail')}}" class="hvr-skew-backward" style="margin-bottom:20px;">Edit</a>
          
        </div><!-- /.col-sm-4 -->
        

        <div class="col-sm-6">
          
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Shipping Detail</h3>
            </div>
            <div class="panel-body">
            <p>{{$sFirstName." ".$sLastName}}</p>
              <p>{{$sAddress1}}</p>
              <p>{{$sAddress2}}</p>
              <p>{{$sCityTown}}</p>
              <p>{{$sState}}</p>
              <p>{{$sPostcode}}</p>
              <p>{{$sCountry}}</p>
              <p>{{$sEmail}}</p>
              <p>{{$sPhone}}</p>
            </div>
          </div>
          <a href="{{ route('payment') }}" class="hvr-skew-backward">Proceed To Payment</a>

        </div><!-- /.col-sm-4 -->
        
        
      </div>

    </div>
    
   
        
</div>
 
@endsection