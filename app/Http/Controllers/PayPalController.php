<?php

namespace App\Http\Controllers;

use App\BillingShipping;
use App\Cart;
use App\Sales;
use App\SalesCart;
use App\SalesBillingShipping;
use App\MailSendController;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    //
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $data = [];
        $cartRows = Cart::where('session_id',session()->getId())->get();
        $totalAmt = 0;
        foreach($cartRows as $row){
            $totalAmt+=$row->total_price;
        }
        //dd($totalAmt);

        $data['items'] = [
            [
                'name' => '8848supplies',
                'price' => $totalAmt,
                'desc'  => 'Shopping From 8848 Supplies',
                'qty' => 1
            ]
        ];
  
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $totalAmt;
  
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
  
        $response = $provider->setExpressCheckout($data, true);
  
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        //dd('Your payment is canceled. You can create cancel page here.');
        $detailRow = BillingShipping::where('session_id',session()->getId())->first();
        $failure_title = "Payment Canceled!";
        $failure_description = "The payment has been declined. Please try again.";

        return view('front.correspondence-confirmation', compact(['detailRow', 'failure_title','failure_description']));
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {  
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $response = "success";
            $sessionId = session()->getId();
            
            
            
            //add sales detail
            $sales = new Sales();
            $sales->session_id = $sessionId;
            $sales->sale_status = '1';
            $sales->payment_date = date('Y-m-d H:i:s');
            $sales->payment_status = '1';
            $sales->save();
            

            //Adding into sales Cart 
            $sales_id = $sales->id;

            //generate invoice no. and update sales_table

            $invoice_no = config('global.invoice_prefix').'-'.sprintf("%06s", $sales_id);
            //dd($invoice_no);
            Sales::where('id', $sales_id)->update([
                'invoice_number' => $invoice_no
            ]);
            
            $cartRows = Cart::where('session_id', $sessionId)->get();
            //dd(SalesCart::get());
            if($cartRows){
                foreach($cartRows as $cartRow){
                    $scart = new SalesCart();
                    $scart->sales_id = $sales_id;
                    $scart->product_id = $cartRow->product_id;
                    $scart->mark_price = $cartRow->mark_price;
                    $scart->selling_price = $cartRow->selling_price;
                    $scart->cart_quantity = $cartRow->cart_quantity;
                    $scart->total_price = $cartRow->total_price;
                    $scart->discount_percent = $cartRow->discount_percent;
                    $scart->discount_price = $cartRow->discount_price;
                    $scart->cart_enquiry_desc = $cartRow->cart_enquiry_desc;
                    $scart->order_type = $cartRow->order_type;
                    $scart->save();
                }

            }
            $bRow = BillingShipping::where('session_id', $sessionId)->first();
            //dd($bRow);
            //dd(SalesBillingShipping::get());
            if($bRow){
                    $bsDetail = new SalesBillingShipping();
                    $bsDetail->sales_id = $sales_id;
                    $bsDetail->billing_first_name = $bRow->billing_first_name;
                    $bsDetail->billing_last_name = $bRow->billing_last_name;
                    $bsDetail->billing_address_1 = $bRow->billing_address_1;
                    $bsDetail->billing_address_2 = $bRow->billing_address_2;
                    $bsDetail->billing_town = $bRow->billing_town;
                    $bsDetail->billing_state = $bRow->billing_state;
                    $bsDetail->billing_postcode = $bRow->billing_postcode;
                    $bsDetail->billing_country = $bRow->billing_country;
                    $bsDetail->billing_email = $bRow->billing_email;
                    $bsDetail->billing_phone = $bRow->billing_phone;
                    $bsDetail->same_as_billing = $bRow->same_as_billing;
                    $bsDetail->shipping_first_name = $bRow->shipping_first_name;
                    $bsDetail->shipping_last_name = $bRow->shipping_last_name;
                    $bsDetail->shipping_address_1 = $bRow->shipping_address_1;
                    $bsDetail->shipping_address_2 = $bRow->shipping_address_2;
                    $bsDetail->shipping_town = $bRow->shipping_town;
                    $bsDetail->shipping_state = $bRow->shipping_state;
                    $bsDetail->shipping_postcode = $bRow->shipping_postcode;
                    $bsDetail->shipping_country = $bRow->shipping_country;
                    $bsDetail->shipping_email = $bRow->shipping_email;
                    $bsDetail->shipping_phone = $bRow->shipping_phone;
                    $bsDetail->description = $bRow->description;
                    $bsDetail->save();  

            }
    
            BillingShipping::where('session_id', $sessionId)->delete();
            Cart::where('session_id', $sessionId)->delete();
            //return redirect()->route('send-mail');
            return redirect('/purchase-success/'.$sales_id);//->action('MailSendController@mailsend', ['sale_id' => $sales_id]);
            //return redirect()->action('MailSendController@mailsend');
            //return view('front.payment-response', compact(['response']));
            //dd('Your payment was successfully. You can create success page here.');
        }
        $detailRow = BillingShipping::where('session_id',session()->getId())->first();
        $failure_title = "Something went wrong!";
        $failure_description = "There is some issue while payment. Please try again.";
        return view('front.correspondence-confirmation', compact(['detailRow', 'failure_title','failure_description']));
  
        //dd('Something is wrong.');
    }
}
