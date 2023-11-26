<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  public function index(){

    $now = Carbon::now();
    $today_start = date('Y-m-d 00:00:00', strtotime($now));
    $today_end = date('Y-m-d 23:59:59', strtotime($now));
    $str_today_start = strtotime($today_start);
    $str_today_end = strtotime($today_end);



    $orders = Order::where('customer_id', '=', auth()->id())->get();
    $total_order = $orders->count();
    $pending_order = 0;
    $processing_order = 0;
    $delivered_order = 0;
    $completed_order = 0;
    $canceled_order = 0;
    $new_order = 0;
    foreach ($orders as $item) {
      if(strtolower($item->status) == 'pending'){
        $pending_order = $pending_order + 1;
      }else if(strtolower($item->status) == 'delivered'){
        $delivered_order = $delivered_order + 1;
      }else if(strtolower($item->status) == 'completed'){
        $completed_order = $completed_order + 1;
      }else if(strtolower($item->status) == 'canceled'){
        $canceled_order = $canceled_order + 1;
      }else{
        $processing_order = $processing_order + 1;
      }

      $orderCreate = strtotime($item->created_at);
      if($str_today_start < $orderCreate  && $orderCreate < $str_today_end){
        $new_order = $new_order + 1;
      }
    }

    $order = [
      'new' => $new_order,
      'pending' => $pending_order,
      'processing' => $processing_order,
      'delivered' => $delivered_order,
      'completed' => $completed_order,
      'canceled' => $canceled_order,
      'total' => $total_order,
    ];

   return view('site.customer.index', compact('order'));
  }
}
