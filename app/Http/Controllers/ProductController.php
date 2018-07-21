<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;


class ProductController extends Controller
{
    public function getIndex(){
        $products = DB::table('products')->orderBy('sequence', 'asc')->get();
        $columns = Schema::getColumnListing('orders');
        $spots = DB::table('spots')->orderBy('sequence', 'asc')->get();

        // use "first" method to avoid "get" method's problem
        $top = DB::table('bulletin')->where('title','=','top_content')->first();
        $product = DB::table('bulletin')->where('title','=','product_content')->first();

        $top_content = $top->content;
        $product_content = $product->content;

        return view('shop.index', [
            'products' => $products,
            'columns' => $columns,
            'spots' => $spots,
            'top_content' => $top_content,
            'product_content' => $product_content]);
    }

    public function postIndex(Request $request){
        $this->validate($request, [
            '訂購人' => 'required',
            '預訂日期' => 'required',
        ]);

        $columns = Schema::getColumnListing('orders');


        $order = new Order;

        $total = 0;

        for ($i=0; $i<count($columns); $i++){
            $orderValue = $request->input($columns[$i]);
            $orderColumn = $columns[$i];
            $order -> $orderColumn = $orderValue;

            if ($i>5){
                $total += (int)$orderValue;
            }
        }

        $all = '總數量';
        $order -> $all = $total;

        $sum = '總金額';
        $order -> $sum = $request->input('total_dollar');

        $order->save();

        return redirect()->route('product.index');
    }
}
