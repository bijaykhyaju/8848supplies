<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public static function getCategoryById($id){
      return Category::findOrFail($id);
    }
}
