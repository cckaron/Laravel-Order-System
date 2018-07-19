<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function getIndex(){
        $products = DB::table('products')->orderBy('sequence', 'asc')->get();
        $columns = Schema::getColumnListing('orders');
        return view('shop.index', ['products' => $products], ['columns' => $columns]);
    }

    public function postIndex(Request $request){
//        $this->validate($request, [
//            '訂購人' => 'required',
//            '聯絡電話' => 'required',
//            '取貨地點' => 'required',
//            '預定日期' => 'required',
//        ]);

        $columns = Schema::getColumnListing('orders');


        $order = new Order;

        $total = 0;


        for ($i=0; $i<count($columns); $i++){
            $orderValue = $request->input($columns[$i]);
            $orderColumn = $columns[$i];
            $order -> $orderColumn = $orderValue;

            if ($i>4){
                $total += (int)$orderValue;
            }
        }

        $all = '總數量';

        $order -> $all = $total;

        $order->save();

        return redirect()->route('product.index');
    }
}
