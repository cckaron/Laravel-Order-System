<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = ['訂購人', '聯絡電話', '取貨地點', '預定日期', '取貨地點'];
    public $timestamps = false;
}
