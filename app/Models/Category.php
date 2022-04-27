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
    public function getActive()
    {
        $this->is_active == 0 ? 'مفعل' : 'غير مفعل';
    }
}
