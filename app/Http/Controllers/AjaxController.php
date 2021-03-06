<?php

namespace App\Http\Controllers;

use App\Holiday;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AjaxController extends Controller
{
    public function getBread(Request $request){
        $validation = Validator::make($request->all(), [
            '預訂日期' => 'required|date',
        ]);
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
            'error' => $validation->errors()->all(),
        );

        return Response::json($data);
    }

    public function postdata(Request $request){
        $validation = Validator::make($request->all(), [
            'date' => 'required|unique:holidays|date',
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        } else {
            if ($request->get('button_action') == "插入")
            {
                $holiday = new Holiday([
                    'date' => $request->get('date')
                ]);
                $holiday->save();
                $success_output = '<div class="alert alert-success"> 新增成功！ </div>';
            }
        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );
        echo json_encode($output);
    }
}
