<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spot extends Model
{
    protected  $fillable = ['spot', 'content'];
    public $timestamps = false;
}
