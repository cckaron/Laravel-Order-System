<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bulletin extends Model
{
    protected  $fillable = ['title', 'content'];
    public $timestamps = false;
}
