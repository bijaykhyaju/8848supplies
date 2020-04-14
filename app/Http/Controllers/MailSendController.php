<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\SendMail;

use \App\SalesBillingShipping;

class MailSendController extends Controller
{
    public function mailsend($sale_id)
    {
        //$details = [];
        
        //dd($sale_id);
        $billingShippingRow = SalesBillingShipping::where('sales_id',$sale_id)->first();
        //dd($billingShippingRow);
        $response = "success";

        //email to customer
        \Mail::to($billingShippingRow->billing_email)->send(new SendMail());

        //email to Admin
        $admin_email = config('global.admin_email');
        \Mail::to($admin_email)->send(new SendMail());

        //\Mail::to('khyajubj@gmail.com')->send(new SendMail($details));
        return view('front.payment-response', compact(['response']));

        //return view('front.sendmail',compact('saleRow', 'billingShippingRow', 'salesCartRow'));
    }
}