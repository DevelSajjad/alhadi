<?php

namespace App\Http\Controllers;

use App\Product;
use App\Subscription;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
  public function add_to_wishlist($product_id = null){
    $user_id = auth()->id();
    $product = Product::find($product_id);
    if (isset($user_id) && isset($product)){
      $wishlist = WishList::updateOrCreate(
        [
          'customer_id'=> $user_id,
          'product_id'=> $product_id,
        ],
        [ 'status' => 'active']
      );
      if (isset($wishlist)){
        return 'success';
      }
    }
  }


  public function remove_to_wishlist($id = null){
    $user_id = auth()->id();
    if(WishList::where('customer_id', $user_id)->where('id', $id)->update(['status'=> 'inactive'])){
     return 'success';
    }
  }

  public function customer_wishlist(){
    $user_id = auth()->id();
    $wishlists = DB::table('wishlists')
      ->join('products', 'products.id', '=', 'wishlists.product_id')
      ->where('wishlists.customer_id', $user_id)
      ->where('wishlists.status', 'active')
      ->select('wishlists.id', 'wishlists.updated_at as created_at', 'products.id as product_id', 'products.name as product_name',
        'products.slug as product_slug','products.thumbnail_image as product_image', 'products.price as product_price',
        'products.quantity as product_quantity')->get();

//    return $wishlists;
    return view('site.customer.wishlist', compact('wishlists'));
  }


  /**
   * @param Request $request
   * @return string
   */
  public function subscribe(Request $request){
    if($request->isMethod('POST')){
      $id = $request->post('id');
      $name = $request->post('name');
      $email = $request->post('email');
      $contact_no = $request->post('contact_no');

      if(isset($email)){
        $subscribe = Subscription::where('email', $email)->first();
        if(isset($subscribe)){
          return 'duplicate';
        }
        $subscription = new Subscription();
        $subscription->email = $email;
        $subscription->name = $name;
        $subscription->contact_no = $contact_no;
        if(isset($id)){
          $subscription->customer_id = $id;
        }
        if($subscription->save()){
          return 'success';
        }
      }
    }
  }


}
