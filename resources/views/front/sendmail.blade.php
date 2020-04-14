<html>
    <head>
        <style>
            *{padding:0; margin:0;}
            html{display:flex;}
            body{font-family:arial,sans-serif;font-size:11px;margin: 0 auto;}
            

        </style>

    </head>
    <?php
    $saleRow = App\Sales::getSalesBySessionId();
    
    $billingShippingRow = App\SalesBillingShipping::getBillingShippingBySalesId($saleRow->id);
    $salesCartRow = App\SalesCart::getSalesCartBySalesId($saleRow->id);
    //dd($salesCartRow);

    $invoice_no = $saleRow->invoice_number;

    $billing_first_name = $billingShippingRow->billing_first_name;
    $billing_last_name = $billingShippingRow->billing_last_name;
    $billing_address_1 = $billingShippingRow->billing_address_1;
    $billing_address_2 = $billingShippingRow->billing_address_2;
    $billing_town = $billingShippingRow->billing_town;
    $billing_state = $billingShippingRow->billing_state;
    $billing_postcode = $billingShippingRow->billing_postcode;
    $billing_country = $billingShippingRow->billing_country;
    $billing_email = $billingShippingRow->billing_email;
    $billing_phone = $billingShippingRow->billing_phone;
    //$same_as_billing = $billingShippingRow->same_as_billing;
    $shipping_first_name = $billingShippingRow->shipping_first_name;
    $shipping_last_name = $billingShippingRow->shipping_last_name;
    $shipping_address_1 = $billingShippingRow->shipping_address_1;
    $shipping_address_2 = $billingShippingRow->shipping_address_2;
    $shipping_town = $billingShippingRow->shipping_town;
    $shipping_state = $billingShippingRow->shipping_state;
    $shipping_postcode = $billingShippingRow->shipping_postcode;
    $shipping_country = $billingShippingRow->shipping_country;
    $shipping_email = $billingShippingRow->shipping_email;
    $shipping_phone = $billingShippingRow->shipping_phone;
    //$description = $billingShippingRow->description;
    $grossTotal = 0;
    ?>
    <body>
        <table width='600' align='center' cellpadding='0' cellspacing='0' border='0'  style='background:#FFF;border: 1px solid #F7F7F7;'>
            <tr><td style='padding:0 30px;'>
            <table  width='540' align='center' cellpadding='0' cellspacing='0' border='0'>
                <tr>
                    <td valign='top' align='center' style='padding: 20px 0;'>
                        <br>
                        <img src='{{asset('images/front/logo.png')}}' alt='{{config('global.site_name')}}' width='220'  border='0' />
                    </td>
                </tr>
                <tr><td align='left'>Dear {{ucwords($billing_first_name)}},</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>Thank you for the shopping in 8848 Supplies.</td></tr>
                <tr><td>The invoice number of your purchase is <b>{{$invoice_no}}.</b></td></tr>
                <tr><td>The shopping details and the items that are purchased are as below.</td></tr>
                <tr><td>&nbsp;</td></tr>
            </table>

            <table id='giv-padd' width='540' align='center' border='0' bordercolor='#F7F7F7' style='border-collapse:collapse;'>
                    <tr>
                        <td><b>Billing Details</b></td>
                        <!-- <td><b>Shipping Details</b></td> -->
                    </tr>
                    <tr>
                        <td>
                            <p>{{$billing_first_name." ".$billing_last_name}}</p>
                            <p>{{$billing_address_1}}</p>
                            @isset($billing_address_2)<p>{{$billing_address_2}}</p> @endisset
                            <p>{{$billing_town}}</p>
                            <p>{{$billing_state}}</p>
                            <p>{{$billing_postcode}}</p>
                            <p>{{$billing_country}}</p>
                            <p>{{$billing_email}}</p>
                            @isset($billing_phone)<p>{{$billing_phone}}</p> @endisset
                        </td>
                        <?php /*<td>
                            <p>{{$shipping_first_name." ".$shipping_last_name}}</p>
                            <p>{{$shipping_address_1}}</p>
                            @isset($shipping_address_2)<p>{{$shipping_address_2}}</p> @endisset
                            <p>{{$shipping_town}}</p>
                            <p>{{$shipping_state}}</p>
                            <p>{{$shipping_postcode}}</p>
                            <p>{{$shipping_country}}</p>
                            <p>{{$shipping_email}}</p>
                            @isset($shipping_phone)<p>{{$shipping_phone}}</p> @endisset
                        </td> */?>
                    </tr>
                    
                    
                </table>
                <br><br>
            <table id='giv-padd' width='540' align='center' border='1' bordercolor='#DDDDDD' style='border-collapse:collapse;'>
                <tr><td colspan='4'><b>Items purchased</b></td></tr>
                <tr>
                    <td style='padding-left:10px;'>Name</td>
                    <td width="18%" align='center'>Unit Price($)</td>
                    <td width="15%" align='center'>Quantity</td>
                    <td width="25%" align='center'>Total($)</td>			
                </tr>


                @foreach($salesCartRow as $cart)
                <?php $product = App\Product::getProductById($cart->product_id); 
                    $grossTotal+=$cart->total_price;
                    $gst = ($grossTotal*0.10); //10% of total

                    ?>
                <tr>
                    <td style='padding-left:10px;'>{{$product->name}}</td>
                    <td align='center'>{{$cart->selling_price}}</td>
                    <td align='center'>{{$cart->cart_quantity}}</td>
                    <td align='right' style='padding-right:15px;'>{{$cart->total_price}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" align='right' style='padding-right:25px;'>Gst (Included)</td>
                    <td align='right' style='padding-right:15px;'>{{number_format($gst, 2, '.', ',')}}</td>

                </tr>
                <tr>
                    <td colspan="3" align='center'><b>Total</b></td>
                    <td align='right' style='padding-right:15px;'>{{number_format($grossTotal, 2, '.', ',')}}</td>
                </tr>
            </table>
        </td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td style='padding:0 30px;'>Kind Regards,</td></tr>
                <tr><td style='padding:0 30px;'>8848 Supplies</td></tr>
                <tr><td>&nbsp;</td></tr>
                <tr><td>&nbsp;</td></tr>
        </table>
    </body>
</html>