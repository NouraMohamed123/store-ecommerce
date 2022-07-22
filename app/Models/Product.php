<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded =[];
    public function getActive()
    {
        $this->is_active == 0 ? 'مفعل' : 'غير مفعل';
    }
    public function Brand(){
        return $this->belongsTo(brand::class,'brand_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'product__categories');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product__tags');
    }

    public function Images(){
        return $this->belongsToMany(Tag::class,'product__tags');
    }
}
