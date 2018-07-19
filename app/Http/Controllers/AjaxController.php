<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AjaxController extends Controller
{
    public function getBread(Request $request){
        // value直接得到該值
        $available_Count = DB::table('extras')->where('parameter', 'daily_max')->value('value');
        $available = True;

        $mDate = $request->get('Date');

        $total = 0;
        $canbuy = 0;

        // pluck得到的會是array
        $totalList = DB::table('orders')->where('預訂日期', $mDate)->pluck('總數量');
        foreach ($totalList as $single){
            $total += $single;
        }

        if ($total >= $available_Count){
            $available = False;
        } else {
            $canbuy = $available_Count - $total;
        }

        $data = array(
            'canBuy' => $canbuy,
            'available' => $available,
        );

        return Response::json($data);
    }
}
