<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //Get cart items by session id
    public static function cartCountBySessionId(){
      $sessionId = session()->getId();
      $cartCount = Cart::where('session_id',$sessionId)->count();                      
      return $cartCount;
  }
}
