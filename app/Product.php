<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function isProductPublish($id){
      $isPublish = Product::where('publish','1')
                              ->where('id',$id)
                              ->count();
      return $isPublish>0 ? 'checked' : '';
    }

    public static function getProductById($id){
      return Product::findOrFail($id);
    }
    
}
