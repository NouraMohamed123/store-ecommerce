<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded =[];

    public function Product(){
      return  $this->belongsTo(Product::class,'product_id');
    }
    public function Attribute(){
      return  $this->belongsTo(Attribute::class,'attribute_id');
    }
}
