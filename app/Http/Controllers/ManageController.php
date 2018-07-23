<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ManageController extends Controller
{
    public function getIndex(){

        $columns = Schema::getColumnListing('orders');
        $orders = Order::all();

        return view('manage.admin', ['columns' => $columns], ['orders' => $orders]);
    }

    public function editOrder($id){

        $columns = Schema::getColumnListing('orders');

        $order = DB::table('orders')->where('id','=', $id)->first();

        return view('manage.editOrder', ['order' => $order, 'columns' => $columns]);
    }

    public function postEditOrder(Request $request){
        $this->validate($request, [
            '訂購人' => 'required',
            '取貨地點' => 'required',
            '預訂日期' => 'required',
        ]);

        $columns = Schema::getColumnListing('orders');

        $id = $request->input('id');

        $order = Order::find($id);


        $total = 0;
        $sum = 0;

        for ($i=0; $i<count($columns); $i++){
            $orderValue = $request->input($columns[$i]);
            $orderColumn = $columns[$i];
            $order -> $orderColumn = $orderValue;

            if ($i>8){
                $total += (int)$orderValue;

                // check if column contains "_"
                if (strpos($columns[$i], '_') != True)
                {
                    $product = DB::table('products')->where('id_notSlice', $orderColumn)->first();
                    $price = $product->price;
                }
                else{
                    $name = explode("_", $orderColumn)[0];
                    $product = DB::table('products')->where('id_notSlice', $name)->first();
                    $price = $product->price;
                }

                $sum += (int)$orderValue * $price;

            }
        }

        $all = '總數量';
        $order -> $all = $total;

        $dollar = '總金額';
        $order -> $dollar = $sum;

        $order->save();

        return redirect()->back()->with('message', '修改成功！');    }

    public function destroyOrder($id){
        DB::table('orders')->where('id','=', $id)->delete();

        return redirect()->back();
    }

    public function getProduct(){
        $products = DB::table('products')->orderBy('sequence', 'desc')->get();
        return view('manage.products', ['products' => $products]);
    }


    public function addProduct(){

        return view('manage.addProduct');
    }

    public function postAddProduct(Request $request){
        $this->validate($request, [
            'title' => 'required|unique:products',
            'price' => 'required',
            'unit' => 'required',
            'thickSlice' => 'required|boolean',
            'thinSlice' => 'required|boolean',
        ]);

        $id_thickSlice = '';
        $id_thinSlice = '';
//        $id_product = (string) Str::uuid();
        $product_title = $request->input('title');
        $id_notSlice = $product_title;


        $canSlice = False;

        if ($request->input('thickSlice')){
            $id_thickSlice = $product_title.'_切厚片';
        }
        if ($request->input('thinSlice')){
            $id_thinSlice = $product_title.'_切薄片';
        }

        if ($request->input('thickSlice') || $request->input('thinSlice')){
            $canSlice = True;
        }


        $product = new Product([
            'title' => $product_title,
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'description' => $request->input('price'),
            'canSlice' => $canSlice,
            'thickSlice' => $request->input('thickSlice'),
            'thinSlice' => $request->input('thinSlice'),
            'id_notSlice' => $id_notSlice,
            'id_thickSlice' => $id_thickSlice,
            'id_thinSlice' => $id_thinSlice,

        ]);
        $product->save();

        $type = 'Integer';


        Schema::table('orders', function (Blueprint $table) use ($type, $id_notSlice){
            $table->$type($id_notSlice)->nullable()->default(0);
        });

        if ($request->input('thickSlice')){
            Schema::table('orders', function (Blueprint $table) use ($type, $id_thickSlice){
                $table->$type($id_thickSlice)->nullable()->default(0);
            });
        }

        if ($request->input('thinSlice')){
            Schema::table('orders', function (Blueprint $table) use ($type, $id_thinSlice){
                $table->$type($id_thinSlice)->nullable()->default(0);
            });
        }

        return redirect()->back()->with('message', '新增商品成功！');
    }

    public function editProduct($id){

        $products = DB::table('products')->where('id','=', $id)->get();

        return view('manage.editProduct', ['products' => $products]);
    }

    public function postEditProduct(Request $request){

        //title needs to be unique, except of itself
        $this->validate($request, [
            'title' => 'required|unique:products,title,'.$request->input('id'),
            'price' => 'required',
            'unit' => 'required',
            'sequence' => 'required',
            'thickSlice' => 'required|boolean',
            'thinSlice' => 'required|boolean',
        ]);

        $id = $request->input('id');

        $product = Product::findOrFail($id);

        $type = 'Boolean';


        // Change the Product name in "Product" and "Order" if product name is changed
        if ($product->title != $request->input('title')){
            $title = $request->input('title');
            $before_title = $product->title;
            $before_thick_title = $before_title.'_切厚片';
            $before_thin_title = $before_title.'_切薄片';
            $thick_title = $title.'_切厚片';
            $thin_title =$title.'_切薄片';
            $product->id_notSlice = $title;
            $product->id_thickSlice = $thick_title;
            $product->id_thinSlice = $thin_title;

            Schema::table('orders', function (Blueprint $table) use ($type,$before_title, $title){
                $table->renameColumn($before_title, $title);
            });

            Schema::table('orders', function (Blueprint $table) use ($type,$before_thick_title, $thick_title){
                $table->renameColumn($before_thick_title, $thick_title);
            });

            Schema::table('orders', function (Blueprint $table) use ($type,$before_thin_title, $thin_title){
                $table->renameColumn($before_thin_title, $thin_title);
            });
        }

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->unit = $request->input('unit');
        $product->description = $request->input('description');
        $product->thickSlice = $request->input('thickSlice');
        $product->thinSlice = $request->input('thinSlice');

        $req_thickSlice = $request->input('thickSlice');
        $req_thinSlice = $request->input('thinSlice');


        // Delete column in orders if slice changed
        if ($req_thickSlice == False){
                $id_thickSlice = $product->id_thickSlice;

                if (Schema::hasColumn('orders', $id_thickSlice)){
                    Schema::table('orders', function(Blueprint $table) use ($id_thickSlice) {
                        $table->dropColumn($id_thickSlice);
                    });
                }

        } else {
            $id_thickSlice = $product->id_thickSlice;
            // add it if not has this column yet
            if (!Schema::hasColumn('orders', $id_thickSlice)){
                Schema::table('orders', function (Blueprint $table) use ($type, $id_thickSlice){
                    $table->$type($id_thickSlice)->nullable()->default(0);
            });
            }
        }

        if ($req_thinSlice == False){
            $id_thinSlice = $product->id_thinSlice;

            if (Schema::hasColumn('orders', $id_thinSlice)){
                Schema::table('orders', function(Blueprint $table) use ($id_thinSlice) {
                    $table->dropColumn($id_thinSlice);
                });
            }

        } else {
            $id_thinSlice = $product->id_thinSlice;
            // add it if not has this column yet
            if (!Schema::hasColumn('orders', $id_thinSlice)){
                Schema::table('orders', function (Blueprint $table) use ($type, $id_thinSlice){
                    $table->$type($id_thinSlice)->nullable()->default(0);
                });
            }
        }




        $product->save();

        if ($product->thickSlice == False && $product->thinSlice == False){
            $product->canSlice = False;
        } else {
            $product->canSlice = True;
        }
        $product->save();




        return redirect()->back()->with('message', '修改成功！');
    }

    public function destroyProduct($id){
        $product = DB::table('products')->where('id','=', $id);

        $id_notSlice = $product->get(['id_notSlice'])[0]->id_notSlice;

        // 無論如何產品一定有notSlice，所以要刪掉orders內的id_notSlice
        Schema::table('orders', function(Blueprint $table) use ($id_notSlice) {
            $table->dropColumn($id_notSlice);
        });

        // 如果產品thickSlice為true，就刪掉orders內的id_thickSlice
        if ($product->get(['thickSlice'])[0]->thickSlice){
            $id_thickSlice = $product->get(['id_thickSlice'])[0]->id_thickSlice;
            Schema::table('orders', function(Blueprint $table) use ($id_thickSlice) {
                $table->dropColumn($id_thickSlice);
            });
        }

        // 如果產品thinSlice為true，就刪掉orders內的id_thinSlice
        if ($product->get(['thinSlice'])[0]->thinSlice){
            $id_thinSlice = $product->get(['id_thinSlice'])[0]->id_thinSlice;
            Schema::table('orders', function(Blueprint $table) use ($id_thinSlice) {
                $table->dropColumn($id_thinSlice);
            });
        }

        // 最後再刪掉product
        DB::table('products')->where('id','=', $id)->delete();

        // 更新order的總數量
        $orders = Order::all();
        $columns = Schema::getColumnListing('orders');
        $all = '總數量';

        foreach ($orders as $order){
            $total = 0;
            for ($i=8; $i<count($columns); $i++){
                $column = $columns[$i];
                $orderValue = $order->$column;
                $total += (int)$orderValue;
            }
            $order->$all = $total;
            $order->save();
        }

        return redirect()->back();
    }

    public function getHoliday(){
        $days = array(
            0 => '日',
            1 => '一',
            2 => '二',
            3 => '三',
            4 => '四',
            5 => '五',
            6 => '六');
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
        return view('manage.holidays', ['holidays' => $holidays, 'holidayArray' => $holidayArray ,'days' => $days]);
    }

    public function destroyHoliday($id){
        DB::table('holidays')->where('id', '=', $id)->delete();
        return redirect()->back();
    }

    public function getBulletin(){

        // use "first" method to avoid "get" method's problem
        $topContent = DB::table('bulletin')->where('title','=','top_content')->first();
        $topTitle = DB::table('bulletin')->where('title','=','top_title')->first();
        $intro = DB::table('bulletin')->where('title','=','introduction')->first();
        $product = DB::table('bulletin')->where('title','=','product_content')->first();
        $max = DB::table('extras')->where('parameter','=','daily_max')->first();

        $top_content = $topContent->content;
        $top_title = $topTitle->content;
        $introduction = $intro->content;
        $product_content = $product->content;
        $daily_max = $max->value;

        return view('manage.bulletin', [
            'top_content' => $top_content,
            'top_title' => $top_title,
            'introduction' => $introduction,
            'product_content' => $product_content,
            'daily_max' => $daily_max]);
    }

    public function postBulletin(Request $request){
        $this->validate($request, [
            'daily_max' => 'required|integer',
        ]);

        DB::table('bulletin')
            ->where('title', 'top_content')
            ->update(['content' => $request->input('top_content')]);

        DB::table('bulletin')
            ->where('title', 'top_title')
            ->update(['content' => $request->input('top_title')]);

        DB::table('bulletin')
            ->where('title', 'introduction')
            ->update(['content' => $request->input('introduction')]);

        DB::table('bulletin')
            ->where('title', 'product_content')
            ->update(['content' => $request->input('product_content')]);

        return redirect()->back()->with('message', '修改成功！');
    }

    public function getSpot(){
        $spots = DB::table('spots')->orderBy('sequence', 'asc')->get();

        return view('manage.spots', ['spots' => $spots]);
    }

    public function addSpot(){

        return view('manage.addSpot');
    }

    public function postAddSpot(Request $request){
        $this->validate($request, [
            'spot' => 'required|unique:spots',
            'sequence' => 'required',
            'content' => 'required',
        ]);

        DB::table('spots')->insert([
                'spot' => $request->input('spot'),
                'sequence' => $request->input('sequence'),
                'content' => $request->input('content')
            ]);

        return redirect()->back()->with('message', '新增地點成功！');
    }

    public function editSpot($id){

        $spots = DB::table('spots')->where('id','=', $id)->get();

        return view('manage.editSpot', ['spots' => $spots]);
    }

    public function postEditSpot(Request $request){
        // spot needs to be unique, except of itself
        $this->validate($request, [
            'spot' => 'required|unique:spots,spot,'.$request->input('id'),
            'sequence' => 'required',
            'content' => 'required',
        ]);

        $id = $request->input('id');

        DB::table('spots')
            ->where('id', $id)
            ->update([
                'spot' => $request->input('spot'),
                'sequence' => $request->input('sequence'),
                'content' => $request->input('content'),
            ]);

        return redirect()->back()->with('message', '修改成功！');
    }

    public function destroySpot($id){
        DB::table('spots')->where('id','=', $id)->delete();

        return redirect()->back();
    }
}
