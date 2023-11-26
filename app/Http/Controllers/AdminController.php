<?php

namespace App\Http\Controllers;

use App\AdminContact;
use App\BestSellingProduct;
use App\Message;
use App\Order;
use App\Payment;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdminController extends Controller
{
    public function index(){
//      $best_sell = BestSellingProduct::selectRaw('id, product_id, sum(number_of_product_sale) as sell')->orderBy('sell')->groupBy('product_id')->get();
//      return $best_sell;
      $now = Carbon::now();
      $today_start = date('Y-m-d 00:00:00', strtotime($now));
      $today_end = date('Y-m-d 23:59:59', strtotime($now));

      $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
      $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

      $payment = Payment::where('created_at', '>=', $month_start)
        ->where('created_at', '<=', $month_end)
        ->where('status', 'success')
        ->select('amount')->get()->sum('amount');
//      return $month_start. " <==> " .$month_end . "=== ".$payment;

      $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
      $m_income = 0;
      $m_product_sell = 0;
      $m_pending_order = 0;
      $m_processing_order = 0;
      $m_delivered_order = 0;
      $m_completed_order = 0;
      $m_canceled_order = 0;
      foreach ($monthlyOrder as $item){
        if(strtolower($item->status) == 'pending'){
          $m_pending_order = $m_pending_order + 1;
        }else if(strtolower($item->status) == 'delivered'){
          $m_delivered_order = $m_delivered_order + 1;
        }else if(strtolower($item->status) == 'completed'){
          $m_completed_order = $m_completed_order + 1;
          $m_income = $m_income + $item->amount;
          foreach (unserialize($item->products) as $val){
            $m_product_sell = $m_product_sell + $val->quantity;
          }
        }else if(strtolower($item->status) == 'canceled'){
          $m_canceled_order = $m_canceled_order + 1;
        }else if(strtolower($item->status) == 'processing'){
          $m_processing_order = $m_processing_order + 1;
        }
      }
      $monthly =[
        'income' => $payment,
        'product' => $m_product_sell,
        'pending' => $m_pending_order,
        'processing' => $m_processing_order,
        'delivered' => $m_delivered_order,
        'completed' => $m_completed_order,
        'canceled' => $m_canceled_order,
        'total_order' => $monthlyOrder->count(),
      ];

//      return $monthly;



//      return "hello";



      $str_today_start = strtotime($today_start);
      $str_today_end = strtotime($today_end);

      $users = User::where('type', '=', 'customer')->get();
      $total_customer = $users->count();
      $active_customer = 0;
      $inactive_customer = 0;
      $new_customer = 0;
      foreach ($users as $item) {
        if(strtolower($item->status) == 'active'){
          $active_customer = $active_customer + 1;
        }else{
          $inactive_customer = $inactive_customer + 1;
        }
        $userCreate = strtotime($item->created_at);
        if($str_today_start < $userCreate  && $userCreate < $str_today_end){
          $new_customer = $new_customer + 1;
        }
      }

      $user = [
        'new' => $new_customer,
        'active'=> $active_customer,
        'inactive'=> $inactive_customer,
        'total' => $total_customer
      ];

      $orders = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.customer_id')
        ->select('orders.*', 'users.name as customer_name', 'users.mobile_no as customer_contact_no')
        ->get();;
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
        }else if(strtolower($item->status) == 'processing'){
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

      $products = Product::all();
      $total_product = $products->count();
      $available_product = 0;
      $stock_out_product = 0;
      $new_product = 0;
      foreach ($products as $item) {
        if($item->quantity > 0){
          $available_product = $available_product + 1;
        }else{
          $stock_out_product = $stock_out_product + 1;
        }

        $productCreate = strtotime($item->created_at);
        if($str_today_start < $productCreate  && $productCreate < $str_today_end){
          $new_product = $new_product + 1;
        }
      }

      $product = [
        'new' => $new_product,
        'available' => $available_product,
        'stock_out' => $stock_out_product,
        'total' => $total_product
      ];


      return view("admin.dashboard", compact('user', 'product', 'order', 'monthly' ));
    }


    public function per_month_income(){
      
      $now = Carbon::now();
      $today_start = date('Y-m-d 00:00:00', strtotime($now));
      $today_end = date('Y-m-d 23:59:59', strtotime($now));

      $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
      $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

      $payment = Payment::where('created_at', '>=', $month_start)
        ->where('created_at', '<=', $month_end)
        ->where('status', 'success')
        ->select('amount')->get()->sum('amount');
//      return $month_start. " <==> " .$month_end . "=== ".$payment;

      $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
      $m_income = 0;
      $m_product_sell = 0;
      $m_pending_order = 0;
      $m_processing_order = 0;
      $m_delivered_order = 0;
      $m_completed_order = 0;
      $m_canceled_order = 0;
      foreach ($monthlyOrder as $item){
        if(strtolower($item->status) == 'pending'){
          $m_pending_order = $m_pending_order + 1;
        }else if(strtolower($item->status) == 'delivered'){
          $m_delivered_order = $m_delivered_order + 1;
        }else if(strtolower($item->status) == 'completed'){
          $m_completed_order = $m_completed_order + 1;
          $m_income = $m_income + $item->amount;
          foreach (unserialize($item->products) as $val){
            $m_product_sell = $m_product_sell + $val->quantity;
          }
        }else if(strtolower($item->status) == 'canceled'){
          $m_canceled_order = $m_canceled_order + 1;
        }else if(strtolower($item->status) == 'processing'){
          $m_processing_order = $m_processing_order + 1;
        }
      }
      $monthly =[
        'income' => $payment,
        'product' => $m_product_sell,
        'pending' => $m_pending_order,
        'processing' => $m_processing_order,
        'delivered' => $m_delivered_order,
        'completed' => $m_completed_order,
        'canceled' => $m_canceled_order,
        'total_order' => $monthlyOrder->count(),
      ];
            return view("admin.info.per_month_income", compact('monthly'));
    }



  public function logout(){
    $now = Carbon::now();
    $today_start = date('Y-m-d H:s:i', strtotime($now));

    $user = User::find(\auth()->id());
    $user->update(['log_out_at'=>$today_start]);
    Auth::logout();
    $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
      Logout successful.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>';
    return redirect()->route('admin.login')->with('status', $status);
  }

  public function admin_profile(){
      return view('admin.profile');
  }

  public function admin_change_password(Request $request){
      if($request->isMethod('POST')){
        $data = $request->all();
        $validator = Validator::make($data, [
          'old_password' => 'required|min:6',
          'new_password' => 'required|min:6',
          'confirm_password' => 'required|min:6|same:new_password',
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = Auth::user();

        if(Auth::guard('web')->attempt(['id'=>$user->id,'password'=>$data['old_password'], 'type'=>'admin'])){
          $user->password = Hash::make($data['new_password']);
          $user->save();
          $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulation!!!</strong> Password successfully changed.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          return redirect()->back()->with('status', $status);
        }else{
          $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
            <strong>Sorry!!!</strong> Something went wrong.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          return redirect()->back()->with('status', $status)->withInput();
        }
      }
      return view('admin.change_password');
  }

  public function admin_contact(){
      $contact1 = AdminContact::find(1);
      $contact2 = AdminContact::find(2);
      return view('admin.contact', compact('contact1', 'contact2'));
  }

  public function admin_update_contact1(Request $request){
    if($request->isMethod('POST')) {
      $data = $request->all();
      $validator = Validator::make($data, [
        // 'id1' => 'required|numeric',
        'mobile_no1' => 'required|min:11|numeric',
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      $id1 = $request->id1 ?? 0;
      try {
        AdminContact::updateOrCreate(['id' => $id1], ['mobile_no' => $data['mobile_no1']]);
      } catch (\Throwable $th) {
        //throw $th;
      }
      
      $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
        <strong>Congratulation!!!</strong> Mobile number updated.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';

      return redirect()->back()->with('status1', $status);
    }
  }

  public function admin_update_contact2(Request $request){
    if($request->isMethod('POST')) {
      $data = $request->all();
      $validator = Validator::make($data, [
        // 'id2' => 'required|numeric',
        'mobile_no2' => 'required|min:11|numeric',
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }

      $id2 = $request->id2 ?? 0;

      try {
        AdminContact::updateOrCreate(['id' => $id2], ['mobile_no'=>$data['mobile_no2']]);
       
      } catch (\Throwable $th) {
        //throw $th;
      }

      $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
          <strong>Congratulation!!!</strong> Mobile number updated.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

      return redirect()->back()->with('status2', $status);

    }
  }

  public function stock_out_product(){
    $stock_out_products = DB::table('products')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
      ->where('categories.status', '=', 'active')
      ->where('sub_categories.status', '=', 'active')
      ->where('products.status', '=', 'active')
      ->where('products.quantity', '<', 1)
      ->select('products.id', 'products.name', 'products.thumbnail_image', 'products.price', 'products.quantity', 'products.slug', 'brands.name as brand', 'categories.name as category', 'sub_categories.name as sub_category')
      ->get();

      return view('admin.info.stock_out_product', compact('stock_out_products'));
  }

  public function available_product(){
    $available_products = DB::table('products')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
      ->where('categories.status', '=', 'active')
      ->where('sub_categories.status', '=', 'active')
      ->where('products.status', '=', 'active')
      ->where('products.quantity', '>', 0)
      ->select('products.id', 'products.name', 'products.thumbnail_image', 'products.price', 'products.quantity', 'products.slug', 'brands.name as brand', 'categories.name as category', 'sub_categories.name as sub_category')
      ->get();

      return view('admin.info.available_product', compact('available_products'));
  }

  public function active_customer(){
    $active_customers = User::where('status', '=', 'active')->where('type', '=', 'customer')->select('created_at', 'image', 'name', 'email', 'mobile_no')->get();
    return view('admin.info.active_customer', compact('active_customers'));
  }

  public function inactive_customer(){
    $inactive_customers = User::where('status', '=', 'inactive')->where('type', '=', 'customer')->select('created_at', 'image', 'name', 'email', 'mobile_no')->get();
    return view('admin.info.inactive_customer', compact('inactive_customers'));
  }

  public function view_customer(){
    $customers = User::where('type', '=', 'customer')->select('created_at', 'image', 'name', 'email', 'mobile_no')->get();
    return view('admin.info.customer', compact('customers'));
  }

  public function pending_orders(){
    $pending_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'pending')
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.pending_order', compact('pending_orders'));
  }

  public function new_orders(){
    $now = Carbon::now();
    $today_start = date('Y-m-d 00:00:00', strtotime($now));
    $today_end = date('Y-m-d 23:59:59', strtotime($now));
    $new_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.created_at', '>=', $today_start)
      ->where('orders.created_at', '<=', $today_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.new_order', compact('new_orders'));
  }

  public function processing_orders(){
    $processing_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'processing')
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.processing_order', compact('processing_orders'));
  }

  public function delivered_orders(){
    $delivered_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'delivered')
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.delivered_order', compact('delivered_orders'));
  }

  public function canceled_orders(){
    $canceled_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'canceled')
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.canceled_order', compact('canceled_orders'));
  }

  public function completed_orders(){
    $completed_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'completed')
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.completed_order', compact('completed_orders'));
  }

  public function total_orders_this_month(){
    $now = Carbon::now();
    $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
    $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

//    $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
    $total_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.created_at', '>', $month_start)->where('orders.created_at','<=', $month_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.total_order_this_month', compact('total_orders', 'now'));
  }

  public function completed_orders_this_month(){
    $now = Carbon::now();
    $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
    $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

//    $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
    $completed_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'completed')
      ->where('orders.created_at', '>', $month_start)->where('orders.created_at','<=', $month_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.completed_order_this_month', compact('completed_orders', 'now'));
  }

  public function pending_orders_this_month(){
    $now = Carbon::now();
    $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
    $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

//    $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
    $pending_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'pending')
      ->where('orders.created_at', '>', $month_start)->where('orders.created_at','<=', $month_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.pending_order_this_month', compact('pending_orders', 'now'));
  }

  public function processing_orders_this_month(){
    $now = Carbon::now();
    $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
    $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

//    $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
    $processing_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'processing')
      ->where('orders.created_at', '>', $month_start)->where('orders.created_at','<=', $month_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.processing_order_this_month', compact('processing_orders', 'now'));
  }

  public function delivered_orders_this_month(){
    $now = Carbon::now();
    $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
    $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

//    $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
    $delivered_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'delivered')
      ->where('orders.created_at', '>', $month_start)->where('orders.created_at','<=', $month_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.delivered_order_this_month', compact('delivered_orders', 'now'));
  }

  public function canceled_orders_this_month(){
    $now = Carbon::now();
    $month_start = date('Y-m-d 00:00:00', strtotime($now->startOfMonth()));
    $month_end = date('Y-m-d 23:59:59', strtotime($now->endOfMonth()));

//    $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
    $canceled_orders = DB::table('orders')
      ->join('users', 'users.id', '=', 'orders.customer_id')
      ->where('orders.status', '=', 'canceled')
      ->where('orders.created_at', '>', $month_start)->where('orders.created_at','<=', $month_end)
      ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
        'orders.amount', 'orders.payment_status', 'orders.status')
      ->get();
    return view('admin.info.canceled_order_this_month', compact('canceled_orders', 'now'));
  }

  public function adminMessageView() {
    $messages = Message::all();
    return view('admin.log.message', compact('messages'));
  }

  public function adminCustomerView() {
    $customers = User::where('type', 'customer')->get();
    return view('admin.log.customer', compact('customers'));
  }

  public function search(Request $request) {

      $now = Carbon::now();
      $today_start = date('Y-m-d 00:00:00', strtotime($now));
      $today_end = date('Y-m-d 23:59:59', strtotime($now));

      $month_start = $request->input('fromDate');
      $month_end = $request->input('toDate');

      $payment = Payment::where('created_at', '>=', $month_start)
        ->where('created_at', '<=', $month_end)
        ->where('status', 'success')
        ->select('amount')->get()->sum('amount');
//      return $month_start. " <==> " .$month_end . "=== ".$payment;

      $monthlyOrder = Order::where('created_at', '>', $month_start)->where('created_at','<=', $month_end)->get();
      $m_income = 0;
      $m_product_sell = 0;
      $m_pending_order = 0;
      $m_processing_order = 0;
      $m_delivered_order = 0;
      $m_completed_order = 0;
      $m_canceled_order = 0;
      foreach ($monthlyOrder as $item){
        if(strtolower($item->status) == 'pending'){
          $m_pending_order = $m_pending_order + 1;
        }else if(strtolower($item->status) == 'delivered'){
          $m_delivered_order = $m_delivered_order + 1;
        }else if(strtolower($item->status) == 'completed'){
          $m_completed_order = $m_completed_order + 1;
          $m_income = $m_income + $item->amount;
          foreach (unserialize($item->products) as $val){
            $m_product_sell = $m_product_sell + $val->quantity;
          }
        }else if(strtolower($item->status) == 'canceled'){
          $m_canceled_order = $m_canceled_order + 1;
        }else if(strtolower($item->status) == 'processing'){
          $m_processing_order = $m_processing_order + 1;
        }
      }
      $monthly = [
        'income' => $payment,
        'product' => $m_product_sell,
        'pending' => $m_pending_order,
        'processing' => $m_processing_order,
        'delivered' => $m_delivered_order,
        'completed' => $m_completed_order,
        'canceled' => $m_canceled_order,
        'total_order' => $monthlyOrder->count(),
      ];

      
            return view("admin.info.per_month_income", compact('monthly'));
    
  }

}
