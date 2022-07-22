<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $guarded =[];
    protected $cats = [
        'is_active' => 'boolean',
    ];
}
