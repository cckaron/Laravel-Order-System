<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class extra extends Model
{
    protected  $fillable = ['parameter', 'value'];
    public $timestamps = false;
}
