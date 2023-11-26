<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class ReportController extends Controller
{
    //

    public function index(){
        return View('admin.report.index');
    }

    public function data(Request $request){

        $start = $request->start;
        $end = $request->end;
        $option= $request->option;

        $data = Order::where('created_at','>=',$start)
                ->where('created_at','<=',$end)  
                ->where('payment_status','=',$option)      
                ->get();
        
        return View('admin.report.index',compact('data'));
    }
}
