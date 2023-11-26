<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class CartController extends Controller
{

  public function index()
  { 
    if (auth()->user() == null) {
      \Session::put('checkout', '1');
      if (isset($_COOKIE['customer_data'])) {
        $customerData = json_decode($_COOKIE['customer_data']);
      }
      $customerData = '';
      return view('site.cart', compact('customerData'));
      // return redirect()->route('login');
    } else {
      if (auth()->user()->type != 'customer') {
        Auth::logout();
        \Session::put('checkout', '1');
        return redirect()->route('login');
      }
    }
   
    return view('site.cart');
  }


  public function add_to_cart(Request $request)
  {
//    $carbonDate = new Carbon(Carbon::now());
    $product_id = $request->post('product_id');
    $quantity = $request->post('quantity');
    if ($product_id > 0 && $quantity > 0) {
      $color = $request->post('color');
      if (!isset($color)) {
        $color = "no color";
      }
      // get product attributes
      $product = Product::where('id', '=', $product_id)
        ->where('status', '=', 'active')
        ->where('status', '=', 'active')
        ->first();
      $has_many = 'no';
      $item = \Cart::get($product->id);
      if (isset($item)) {
        if ($item->quantity >= 1) {
          $has_many = 'yes';
        }
//        if ($item->quantity >= $product->quantity) {
//          return response()->json(['available' => "no"]);
//        }

        $checkQty = $item->quantity + $quantity;
        if ($checkQty > $product->quantity) {
          return response()->json(['available' => "no"]);
        }
      }
      if (isset($product)) {
        $product_to_add = array(
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'quantity' => $quantity,
          'attributes' => array(
            'code' => $product->code,
            'image' => $product->thumbnail_image,
            'color' => $color,
          )
        );

//          \Cart::clear();
        \Cart::add($product_to_add);
        $cotent = \Cart::getContent();
        $total_item = \Cart::getTotalQuantity();
        $cart_total = \Cart::getTotal();
        return response()->json(['totalItem' => $total_item, 'content' => $cotent, 'total' => $cart_total, 'has_many' => $has_many, 'status' => 'success']);
      }
    }
    return response()->json(['error' => "Failed"]);

  }

  public function remove_cart_item($id)
  {
    if (!empty($id)) {
      \Cart::remove($id);
    }
    return redirect()->back();
  }

  public function update_cart(Request $request)
  { 
    if ($request->isMethod('post')) {
      $qty = $request->post('qty');
      $rowId = $request->post('rowId');
      if ($qty > 0) {
//        \Cart::update($rowId, ['quantity'=> -$qty]);

        $newArray = array();
        foreach (\Cart::getContent() as $item) {
          if ($item->id == $rowId) {
            $product = Product::where('id', '=', $item->id)
              ->where('status', '=', 'active')
              ->where('status', '=', 'active')
              ->first();
            if (isset($product)) {
              $newArray[] = array(
                "id" => $item->id,
                "name" => $item->name,
                "price" => $item->price,
                "quantity" => ($qty <= $product->quantity) ? $qty : $product->quantity,
                "attributes" => $item->attributes,
              );
            }
          } else {
            $newArray[] = array(
              "id" => $item->id,
              "name" => $item->name,
              "price" => $item->price,
              "quantity" => $item->quantity,
              "attributes" => $item->attributes,
            );
          }
        }
//        return $newArray;
        \Cart::clear();
        if (count($newArray) > 0) {
          \Cart::add($newArray);
        }
      }
    }
    return redirect()->back();
  }
}
