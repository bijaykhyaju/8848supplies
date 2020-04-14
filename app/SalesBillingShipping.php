<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesBillingShipping extends Model
{
    public static function getBillingShippingBySalesId($id){
        $bSrow = SalesBillingShipping::where('sales_id', $id)->latest()->first();
        return $bSrow;
    }
}
