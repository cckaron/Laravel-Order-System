<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable = [
        'title','price','unit','description',
        'canSlice', 'thickSlice', 'thinSlice',
        'id_product', 'id_notSlice', 'id_thickSlice', 'id_thinSlice'];
}
