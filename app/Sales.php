<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public static function getSalesBySessionId(){
        $sessionId = session()->getId();
        $saleRow = Sales::where('session_id', $sessionId)->latest()->first();
        return $saleRow;
    }
}
