<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Category extends Model
{

    protected $guarded = [];

    protected $cats = [
        'is_active' => 'boolean',
    ];

    public function scopeParent($query){
        return $query -> whereNull('parent_id');
    }
    public function scopeChild($query){
        return $query -> whereNotNull('parent_id');
    }

    public function getActive()
    {
        $this->is_active == 0 ? 'مفعل' : 'غير مفعل';
    }
    public function parent1(){
        return $this->belongsTo(self::class,'parent_id');
    }
    public function products()
    {
        return $this -> belongsToMany(Product::class,'product__categories');
    }
}
