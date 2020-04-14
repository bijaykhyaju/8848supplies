@extends('front.layouts.front-template')

@section('mainContainer')

<div class="banner-top">
	<div class="container">
		<h1>Correspondence</h1>
		<em></em>
		<h2><a href="{{url('/index')}}">Home</a><label>/</label><a href="{{url('/cart')}}">Cart</a><label>/</label>Correspondence</h2>
	</div>
</div>



<div class="container mar-bottom">
    
    <div class="login">
            @if ($errors->any())
            <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form id="correspond-form" name="correspond-form" method="post" enctype="multipart/form-data" action="{{url('/correspondence-submit')}}">
            @csrf
            <div class="col-md-6 login-do">
                <?php
                $bFirstName = "billing_first_name";
                $bLastName = "billing_last_name";
                $bAddress1 = "billing_address_1";
                $bAddress2 = "billing_address_2";
                $bCityTown = "billing_town";
                $bState = "billing_state";
                $bPostcode = "billing_postcode";
                $bCountry = "billing_country";
                $bEmail = "billing_email";
                $bPhone = "billing_phone";
                $sFirstName = "shipping_first_name";
                $sLastName = "shipping_last_name";
                $sAddress1 = "shipping_address_1";
                $sAddress2 = "shipping_address_2";
                $sCityTown = "shipping_town";
                $sState = "shipping_state";
                $sPostcode = "shipping_postcode";
                $sCountry = "shipping_country";
                $sEmail = "shipping_email";
                $sPhone = "shipping_phone";

                if(isset($detailRow) && $detailRow->same_as_billing==1){
                    $sameAsBilling = 'on';
                }
                ?>
                
                <h3 class="cor-title">Billing Detail</h3>
             
                <div class="login-mail">  
                    {!! Form::text($bFirstName, $detailRow->billing_first_name ?? old($bFirstName), ['id' => $bFirstName, 'placeholder' => 'First Name*']) !!}    
                </div>
                <div class="login-mail">
                    {!! Form::text($bLastName, $detailRow->billing_last_name ?? old($bLastName), ['id' => $bLastName, 'placeholder' => 'Last Name*']) !!}
                    
                </div>
                <div class="login-mail">
                    {!! Form::text($bAddress1, $detailRow->billing_address_1 ?? old($bAddress1), ['id' => $bAddress1, 'placeholder' => 'Address Line 1*']) !!}    
                </div>
                <div class="login-mail">
                    {!! Form::text($bAddress2, $detailRow->billing_address_2 ?? old($bAddress2), ['id' => $bAddress2, 'placeholder' => 'Address Line 2']) !!}
                </div>
                <div class="login-mail">
                    {!! Form::text($bCityTown, $detailRow->billing_town ?? old($bCityTown), ['id' => $bCityTown, 'placeholder' => 'City/Town*']) !!}
                </div>
                
                <div class="login-mail">
                    {!! Form::text($bState, $detailRow->billing_state ?? old($bState), ['id' => $bState, 'placeholder' => 'State*']) !!}    
                </div>
                <div class="login-mail">
                    {!! Form::text($bPostcode, $detailRow->billing_postcode ?? old($bPostcode), ['id' => $bPostcode, 'placeholder' => 'Postcode*']) !!}
                </div>
                <div class="login-mail">
                    {!! Form::text($bCountry, $detailRow->billing_country ?? old($bCountry), ['id' => $bCountry, 'placeholder' => 'Country*']) !!}
                </div>
                <div class="login-mail">
                    {!! Form::text($bEmail, $detailRow->billing_email ?? old($bEmail), ['id' => $bEmail, 'placeholder' => 'Email Address*']) !!}
				</div>
                <div class="login-mail">
                    {!! Form::text($bPhone, $detailRow->billing_phone ?? old($bPhone), ['id' => $bPhone, 'placeholder' => 'Phone Number']) !!}
				</div>
                <div class="news-letter " href="javascript:;">
                        <label class="same_billing_shipping">
                        {!! Form::checkbox('same_billing_shipping', $sameAsBilling ?? old('same_billing_shipping'),$sameAsBilling ??  null, ['id' => 'same_billing_shipping',]) !!}
                            <!-- <input type="checkbox" name="same_billing_shipping" id="same_billing_shipping"> -->
                            <i> </i>Use same details for Shipping Address</label>
                </div>
                
            </div>
            
            <div class="col-md-6 login-right">
                <h3 class="cor-title">Shipping Detail</h3>   
                <div class="login-mail">
                    
                    {!! Form::text($sFirstName, $detailRow->shipping_first_name ?? old($sFirstName), ['id' => $sFirstName, 'placeholder' => 'First Name*']) !!}
                    
                </div>
                <div class="login-mail">
                {!! Form::text($sLastName, $detailRow->shipping_last_name ??  old($sLastName), ['id' => $sLastName, 'placeholder' => 'Last Name*']) !!}
                    
                </div>
                <div class="login-mail">
                {!! Form::text($sAddress1, $detailRow->shipping_address_1 ??  old($sAddress1), ['id' => $sAddress1, 'placeholder' => 'Address Line 1*']) !!}
                    
                </div>
                <div class="login-mail">
                {!! Form::text($sAddress2, $detailRow->shipping_address_2 ??  old($sAddress2), ['id' => $sAddress2, 'placeholder' => 'Address Line 2']) !!}
                    
                </div>
                <div class="login-mail">
                {!! Form::text($sCityTown, $detailRow->shipping_town ??  old($sCityTown), ['id' => $sCityTown, 'placeholder' => 'City/Town*']) !!}
                    
                </div>
                
                <div class="login-mail">
                {!! Form::text($sState, $detailRow->shipping_state ??  old($sState), ['id' => $sState, 'placeholder' => 'State*']) !!}
                   
                </div>
                <div class="login-mail">
                {!! Form::text($sPostcode, $detailRow->shipping_postcode ??  old($sPostcode), ['id' => $sPostcode, 'placeholder' => 'Postcode*']) !!}
                    
                </div>
                <div class="login-mail">
                {!! Form::text($sCountry, $detailRow->shipping_country ??  old($sCountry), ['id' => $sCountry, 'placeholder' => 'Country*']) !!}
                    
                </div>
                <div class="login-mail">
                {!! Form::text($sEmail, $detailRow->shipping_email ??  old($sEmail), ['id' => $sEmail, 'placeholder' => 'Email Address*']) !!}
					
                </div>
                <div class="login-mail">
                {!! Form::text($sPhone, $detailRow->shipping_phone ??  old($sPhone), ['id' => $sPhone, 'placeholder' => 'Phone Number']) !!}
					
				</div>
                <div class="news-letter login-do" href="javascript:;">
                        <label class="agree_term">
                            <input type="checkbox" name="agree_term" id="agree_term">
                             <i></i>We will never share your personal details with third parties. By clicking the check box above, you agree with our Privacy Policy.
                        </label>
                </div>
                <label class="hvr-skew-backward">
                    <input type="submit" value="Next">
                </label>

            </div>
            
            <div class="clearfix"> </div>
        </form>
    </div>    

        
</div>
<script>
    $('#billing_first_name').blur(function(){
            if($(this).val()=="bijay"){
                $('#billing_first_name').val('Bijay');
                $('#billing_last_name').val('Khyaju');
                $('#billing_address_1').val('7/15 Curie Avenue');
                $('#billing_address_2').val('');
                $('#billing_town').val('Oak Park');
                $('#billing_state').val('VIC');
                $('#billing_postcode').val('3046');
                $('#billing_country').val('Australia');
                $('#billing_email').val('mkhyajubj@gmail.com');
                $('#billing_phone').val('0451087243');           
        }
    });
    $('#same_billing_shipping').click(function(){
        if ($(this).is(':checked')) {
            $('#shipping_first_name').val($('#billing_first_name').val());
            $('#shipping_last_name').val($('#billing_last_name').val());
            $('#shipping_address_1').val($('#billing_address_1').val());
            $('#shipping_address_2').val($('#billing_address_2').val());
            $('#shipping_town').val($('#billing_town').val());
            $('#shipping_state').val($('#billing_state').val());
            $('#shipping_postcode').val($('#billing_postcode').val());
            $('#shipping_country').val($('#billing_country').val());
            $('#shipping_email').val($('#billing_email').val());
            $('#shipping_phone').val($('#billing_phone').val());  
        } else {
            $('#s_first_name').val('');
            $('#s_last_name').val('');
            $('#s_address1').val('');
            $('#s_address2').val('');
            $('#s_city_town').val('');
            $('#s_state').val('');
            $('#s_postcode').val('');
            $('#s_country').val('');
            $('#s_email').val('');
            $('#s_phone').val('');
        }     
    });
</script>

 

@endsection