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
        $topContent = DB::table('bulletin')->where('title','=','top_content')->first();
        $topTitle = DB::table('bulletin')->where('title','=','top_title')->first();
        $product = DB::table('bulletin')->where('title','=','product_content')->first();

        $intro = DB::table('bulletin')->where('title','=','introduction')->first();


        $top_content = $topContent->content;
        $top_title = $topTitle->content;
        $introduction = $intro->content;
        $product_content = $product->content;

        //get holidays
        $holidays = DB::table('holidays')->orderBy('date', 'asc')->get();
        $holidayArray = array();
        foreach ($holidays as $holiday){
            array_push($holidayArray, $holiday->date);
        }

//        foreach ($holidays as $holiday){
//            $temp = date('m-d-Y', strtotime($holiday->date));
//
//            // if month is "07" not "7" or date is "08" not "8", get rid of the "0" in index 0
//            $temp2 = sscanf($temp, '%d-%d-%d');
//
//            $month = $temp2[0];
//            $date = $temp2[1];
//            $year = $temp2[2];
//
//
//            $realDate = $month.'-'.$date.'-'.$year;
//
//            array_push($holidayArray, $realDate);
//        }

        return view('shop.index', [
            'products' => $products,
            'columns' => $columns,
            'spots' => $spots,
            'top_content' => $top_content,
            'top_title' => $top_title,
            'product_content' => $product_content,
            'holidayArray' => $holidayArray,
            'introduction' => $introduction]);
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

        return redirect()->back()->with('message', '訂購成功！');
    }
}
