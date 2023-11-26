<?php

namespace App\Http\Controllers;

use App\AdminContact;
use App\BestSellingProduct;
use App\Helper\CustomHelper;
use App\Log;
use App\Models\CompanyInfo;
use App\Order;
use App\Payment;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Session;

class OrderController extends Controller
{
    public function getCartTotal()
    {
        foreach (\Cart::getContent() as $item) {
            $product = Product::find($item->id);
            if (!isset($product)) {
                return false;
            }
            if ($product->quantity < $item->quantity) {
                return false;
            }
        }
        return \Cart::getTotal();
    }

    public function proceed_to_payment(Request $request)
    {   
        if ($request->isMethod('POST')) {
        //    return $request;
            $user = \auth()->user();
            // if (!isset($user->address)) {
            //     return redirect()->route('customer.updateProfile');
            // }

            if (!isset($user)) {
                if (!isset($_COOKIE['customer_data'])) {
                    $customerId = CustomHelper::customer_unique_num();
                    $arrayData = [
                        'billing_name'      => $request->billing_name,
                        'billing_phone'     => $request->billing_phone,
                        'billing_address'   => $request->billing_address,
                        'customer_id'       => $customerId,
                    ];
                    setcookie('customer_data', json_encode($arrayData), time() + (4 * 30 * 24 * 60), "/");
                } else {
                    $customerData = json_decode($_COOKIE['customer_data']);
                    $customerId = $customerData->customer_id;
                }
            }

            $cartData = \Cart::getContent();
            // $vat=\(Cart::getTotal()/100)*5;
            $cartTotal = \Cart::getTotal();

            if($request->coupon_amount > 0 && $cartTotal >= 5000){
                $cartTotal = $cartTotal - $request->coupon_amount;
            }

            if ($cartTotal == false) {
                \Cart::clear();
                return redirect()->route('customer.checkout');
            }

            $total = $cartTotal;
            $data = $request->all();
//            return $data;

            $validator = Validator::make($data, [
                'delivery'          => 'required',
                'billing_name'      => 'required|string|max:250',
                'billing_phone'     => 'required|numeric|max:14',
                'billing_address'   => 'required',
                'customer_say'      => 'nullable',
            ]);

            if ($request->filled('shipping')) {
                $validator = Validator::make($data, [
                    'shipping_name'      => 'required|string|max:250',
                    'shipping_address'   => 'required|',
                ]);
            }   

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        //    return $data['delivery'];

            if ($data['delivery'] == 'inDhaka') {
                if ($cartTotal < 5000)
                    $total = $cartTotal + 100;
            }
            if ($data['delivery'] == 'outDhaka') {
                if ($cartTotal < 10000)
                    $total = $cartTotal + 200;
            }

            if (count($cartData) < 1) {
                return redirect()->route('home');
            }
            $vat = 0; //(double)($cartTotal * (5 / 100));
            $total = $total + $vat;

            $order = new Order();
            $order->customer_id = $user->id ?? $customerId;
            $order->products = serialize(\Cart::getContent());
            $order->amount = $total;
            $order->vat = $vat;
            $order->area = $data['delivery'];
            $order->payment_type = $data['payment_type'];
            $order->delivery_address = $data['shipping_address'] ?? $data['billing_address'];
            $order->delivery_charge = $total - ($cartTotal + $vat);
            $order->billing_name = $data['billing_name'];
            $order->billing_phone = $data['billing_phone'];
            $order->billing_address = $data['billing_address'];
            $order->shipping_name = $data['shipping_name'] ?? null;
            $order->customer_say = $data['customer_say'] ?? null;
            $order->status = 'enable';
            if ($order->save()) {
                \Cart::clear();

                //SSLCOMMERZ api integration start
                if($data['payment_type'] == 'online') {
                    $post_data = array();
                    $post_data['store_id'] = "melod5ec4e3e41837f";
                    $post_data['store_passwd'] = "melod5ec4e3e41837f@ssl";
                    //                $post_data['store_id'] = "AL Hadi Enterprise";
                    //                $post_data['store_passwd'] = "5ECF8712B9D2531975";
                    $post_data['total_amount'] = $order->amount;
                    // dd($post_data['total_amount']);
                    // $post_data['total_amount'] = $total;
                    $post_data['currency'] = "BDT";
                    $post_data['tran_id'] = "ALHADI_" . $order->id . "@" . $order->customer_id . "_" . uniqid();
                    $post_data['success_url'] = route('thankyou');
                    $post_data['fail_url'] = route('cancel.payment');
                    $post_data['cancel_url'] = route('cancel.payment');
                    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";   # DISABLE TO DISPLAY ALL AVAILABLE7

                    # CUSTOMER INFORMATION7
                    //        $post_data['cus_name'] = $user->name;
                    //        $post_data['cus_email'] =
                    //        $post_data['cus_add1'] =  'cus_add1';//$billing_address->address;
                    //        $post_data['cus_add2'] = 'cus_add2';//"Dhaka";
                    //        $post_data['cus_city'] = 'cus_city'; //$billing_address->city;
                    //        $post_data['cus_state'] =  'cus_city';//$billing_address->city;
                    //        $post_data['cus_postcode'] = 'cus_postcode';//$billing_address->postal_code ;
                    //        $post_data['cus_country'] = 'cus_country';//$billing_address->country ;
                    //        $post_data['cus_phone'] =  $user->mobile_no;
                    //        $post_data['cus_fax'] = "00000000000";


                    // calling ssl api

                    $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
                    //                $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v4/api.php";

                    $handle = curl_init();
                    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
                    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_POST, 1);
                    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


                    $content = curl_exec($handle);

                    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                    if ($code == 200 && !(curl_errno($handle))) {
                        curl_close($handle);
                        //                        return var_dump($content);
                        $sslcommerzResponse = $content;
                    } else {
                        curl_close($handle);

                        $status = '<div class="alert alert-danger alert-dismissible " role="alert">
                                    <strong>FAILED TO CONNECT WITH SSLCOMMERZ API</strong>.
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>';
                        return redirect()->back()->with('status', $status);
                    }

                    # PARSE THE JSON RESPONSE
                    $sslcz = json_decode($sslcommerzResponse, true);

                    if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
                        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                        //                        echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
                        # header("Location: ". $sslcz['GatewayPageURL']);
                        //                        exit;
                        return redirect($sslcz['GatewayPageURL']);
                    }
                }

                $data = [
                    'order_id' => $order->id,
                    'amount' => $total,
                    'card_type' => "Cash on Delivery",
                ];
                return view('site.thankyou')->with('data', $data);
            }
        }
        return redirect()->route('customer.checkout');
    }

    public function thankyou(Request $request)
    {
        if (!isset($request->tran_id)) {
            return redirect()->route('home');
        }
        $tran_id = $request->tran_id;

        $devied = explode('@', $tran_id);
        $order_id = substr($devied[0], 7);
        $user_id = substr($devied[1], 0, strpos($devied[1], '_'));

        $user = User::find($user_id);
        Auth::login($user);

        $data = [
            'order_id' => $order_id,
            'amount' => null,
            'card_type' => null,
        ];
        if ($request->amount && $request->tran_id && strtoupper($request->status) == 'VALID') {
            Payment::updateOrCreate(
                [
                    'order_id' => $order_id,
                    'customer_id' => $user_id,
                    'transaction_id' => $request->tran_id
                ],
                [
                    'paid_by' => $request->card_type,
                    'card_type' => $request->card_type,
                    'type' => 'Online payment',
                    'amount' => $request->amount,
                    'response' => serialize($request->all()),
                    'status' => 'success',
                ]
            );


            $order = Order::find($order_id);
            if ($order->amount <= $request->amount) {
                $order->update(['payment_status' => 'Paid', 'status' => 'pending']);
            } else {
                $order->update(['payment_status' => 'Partial Paid', 'status' => 'pending']);
            }

            foreach (unserialize($order->products) as $item) {
                $this->__update_orderable_product($item->id, $item->quantity);
                $bsp = new BestSellingProduct();
                $bsp->customer_id = $user_id;
                $bsp->order_id = $order->id;
                $bsp->product_id = $item->id;
                $bsp->number_of_product_sale = $item->quantity;
                $bsp->save();
            }
            try {

                $admin_contact = AdminContact::all();
                foreach ($admin_contact as $item) {
                    $this->__sendMessage($item->mobile_no, 'You have a successful order of TK: ' . $request->amount . ', Order No: ' . $order->id . ". From AL Hadi Enterprise");
                }
                $this->__sendMessage(auth()->user()->mobile_no, "Order has been placed. Order ID: " . $order->id . " Amount: " . $request->amount . ". From AL Hadi Enterprise");
            } catch (Exception $ex) {
            }
            $data = [
                'order_id' => $order->id,
                'amount' => $request->amount,
                'card_type' => $request->card_type,
            ];

        }
        return view('site.thankyou')->with('data', $data);
    }


    public function cancel_payment(Request $request)
    {
        if (!isset($request->tran_id)) {
            return redirect()->route('home');
        }
        $tran_id = $request->tran_id;


        $devied = explode('@', $tran_id);
        $order_id = substr($devied[0], 7);
        $user_id = substr($devied[1], 0, strpos($devied[1], '_'));

        $data = [
            'order_id' => $order_id,
            'amount' => null,
            'card_type' => null,
        ];
        if ($request->amount && $request->tran_id) {
            Payment::updateOrCreate(
                [
                    'order_id' => $order_id,
                    'customer_id' => $user_id,
                    'transaction_id' => $request->tran_id
                ],
                [
                    'paid_by' => $request->card_type,
                    'card_type' => $request->card_type,
                    'type' => 'Online payment',
                    'amount' => $request->amount,
                    'response' => serialize($request->all()),
                    'status' => 'failed',
                ]
            );
            try {
                $this->__sendMessage(auth()->user()->mobile_no, "Order has been placed. Order ID: " . $order_id . " Amount: " . $request->amount . ". From AL Hadi Enterprise");
                $admin_contact = AdminContact::all();
                foreach ($admin_contact as $item) {
                    $this->__sendMessage($item->mobile_no, 'You have a pending order of TK: ' . $request->amount . ', Order No: ' . $order_id . ". From AL Hadi Enterprise");
                }
            } catch (Exception $ex) {
            }

        }


        $data = [
            'order_id' => $order_id,
        ];


//    Session::forget('amount');
//    Session::forget('order_id');
        return view('site.cancel_payment')->with('data', $data);
    }


    public function __update_orderable_product($product_id = null, $quantity = null)
    {
        if ($product_id !== null & $quantity !== null) {
            $product = Product::find($product_id);
            if (isset($product)) {
                $update_data = [
                    'quantity' => ($product->quantity - $quantity),
                    'total_sell' => ($product->total_sell + $quantity)
                ];
                if ($product->update($update_data)) {
                    return true;
                }
            }
        }
        return false;
    }


    public function customer_orderlist()
    {
        $orders = Order::where('customer_id', \auth()->id())->get();
//    return $orders;
        return view('site.customer.orders', compact('orders'));
    }


    public function customer_order_details($id = 0)
    {
        if ($id != 0) {
            $order = Order::where('id', $id)->where('customer_id', \auth()->id())->first();
            if (isset($order)) {
                $payment_details = Payment::where('order_id', $order->id)->get();
                // $company_info = CompanyInfo::get();
    //    return $company_info;
                return view('site.customer.order_details', compact('order', 'payment_details'));
            }
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
      Invalid Order.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>';
        return redirect()->route('customer.orders')->with('status', $status);
    }

    public function admin_view_order(Request $request)
    {
        if (isset($request->search_by)) {
            if (isset($request->order_status)) {
                $orders = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.customer_id')
                    ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
                        'orders.amount', 'orders.payment_status', 'orders.delivered_by', 'orders.status')
                    ->where('orders.status', strtolower($request->order_status))
                    ->whereNotIn('orders.status', ['disable'])
                    ->get();
                return view('admin.order.view', compact('orders', 'request'));
            }
            if (isset($request->payment_status)) {
                $orders = DB::table('orders')
                    ->join('users', 'users.id', '=', 'orders.customer_id')
                    ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
                        'orders.amount', 'orders.payment_status', 'orders.delivered_by', 'orders.status')
                    ->where('orders.payment_status', strtolower($request->payment_status))
                    ->whereNotIn('orders.status', ['disable'])
                    ->get();
                return view('admin.order.view', compact('orders', 'request'));
            }
        }
        $orders = DB::table('orders')
            ->leftJoin('users', 'users.id', '=', 'orders.customer_id')
            ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
                'orders.amount', 'orders.payment_status', 'orders.delivered_by', 'orders.status', 'orders.billing_name', 'orders.billing_phone', 'orders.billing_address',)
            ->whereNotIn('orders.status', ['disable'])
            ->get();
//    return $orders;
        return view('admin.order.view', compact('orders', 'request'));
    }

    public function admin_view_order_details($id = null)
    {
        $order = Order::find($id);
        if ($id != null && isset($order)) {
            $user = User::find($order->customer_id);
            $payment_details = Payment::where('order_id', $order->id)->get();
            return view('admin.order.view_details', compact('order', 'payment_details', 'user'));
        }
    }

    public function admin_unpaid_order(Request $request)
    {

        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.customer_id')
            ->select('orders.id', 'orders.created_at', 'users.name as customer_name', 'users.mobile_no as customer_contact_no',
                'orders.amount', 'orders.payment_status', 'orders.delivered_by', 'orders.status')
            ->whereNotIn('orders.payment_status', ['paid'])
            ->get();
//    return $orders;
        return view('admin.order.unpaid', compact('orders', 'request'));
    }

    public function admin_change_order_status(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->post('id');
            $status = $request->post('status');
//            return $status;
            if($status == 'Completed'){
                $order = Order::find($id);
                $user = User::find($order->customer_id);
                $amount = $order->amount;
                $tran_id = "ALHADI_" . $order->id . "@" . $order->customer_id . "_" . uniqid();
                $order->payment_status = "Paid";
                $order->save();
                $payment = new Payment();
                $payment->order_id = $id;
                $payment->customer_id = $user->id;
                $payment->paid_by = "Cash on Delivery";
                $payment->transaction_id = $tran_id;
                $payment->type = "Cash on Delivery";
                $payment->amount = $amount;
                $payment->status = "success";
                $payment->save();
            }
            if (isset($id) && isset($status)) {
                $order = Order::find($id);
                $old_status = $order->status;
                if ($order->update(['status' => strtolower($status)])) {
                    if ($old_status != $status) {
                        $log = new Log();
                        $log->user_id = \auth()->id();
                        $log->order_id = $id;
                        $log->old_status = $old_status;
                        $log->new_status = $status;
                        $log->save();
                    }
                    $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulations!!!</strong> Status successfully updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>';
                    return redirect()->back()->with('status', $status);
                }
            }
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
      Somthing went wrong.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>';
        return redirect()->back()->with('status', $status);
    }


    public function admin_add_delevered_by(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->post('id');
            $name = $request->post('name');
            if (isset($id) && isset($name)) {
                $order = Order::find($id);
                $old_status = $order->status;
//      return $request;

//        $old_delivered = $order->delivered_by;
                if ($order->update(['status' => strtolower('delivered'), 'delivered_by' => $name])) {
                    $log = new Log();
                    $log->user_id = \auth()->id();
                    $log->order_id = $id;
                    $log->old_status = $old_status;
                    $log->new_status = "delivered";
                    $log->save();

                    /*$log = new Log();
                    $log->user_id = \auth()->id();
                    $log->order_id = $id;
                    $log->old_status = $old_delivered;
                    $log->new_status = $status;
                    $log->save();*/

                    $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulations!!!</strong> Status successfully updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>';
                    return redirect()->back()->with('status', $status);
                }
            }
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
      Somthing went wrong.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>';
        return redirect()->back()->with('status', $status);
    }


    public function test()
    {
        return "hello";
    }
}
