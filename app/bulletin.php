<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bulletin extends Model
{
    protected  $fillable = ['top_title', 'top_content','introduction','product_content'];
    public $timestamps = false;
}
