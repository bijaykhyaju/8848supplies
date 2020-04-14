<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCart extends Model
{
    public static function getSalesCartBySalesId($id){
        $cRow = SalesCart::where('sales_id', $id)->get();
        return $cRow;
    }
}
