<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded =[];
    public function getPhotoAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'assets/images/slider/' . $value.'/'.$value);
    }
}
