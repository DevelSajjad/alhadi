<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\StaticAnalysis\HappyPath\AssertIsArray\consume;
use Validator;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function add_review(Request $request, $product_id){
      if($request->isMethod('POST')){
        $data = $request->all();
        $validator = Validator::make($data, [
          'rating' => 'required|numeric',
          'message' => 'required',
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $product = Product::find($product_id);
        if(!isset($product)){
          return redirect()->route('home');
        }

        $has_a_review = Review::where('customer_id', auth()->id())->where('product_id', $product_id)->where('status', 'active')->first();
        if(isset($has_a_review)){
          $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
             <strong>Sorry!!!</strong> already has your review.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
          return redirect()->back()->with('status', $status);
        }

        $review = new Review();
        $review->customer_id = auth()->id();
        $review->product_id = $product_id;
        $review->rating = $data['rating'];
        $review->message = $data['message'];
        if($review->save()){
          $status = '<div class="alert alert-success alert-dismissible show" role="alert">
             <strong>Thank you for your valuable review</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
          return redirect()->back()->with('status', $status);
        }
        $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
          Something went wrong
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>';
        return redirect()->back()->with('status', $status);
      }
    }



    public function admin_view_review($product_id = null){
      $product = Product::find($product_id);
      if(isset($product)){
        $reviews = DB::table('reviews')
          ->leftJoin('users', 'users.id', '=', 'reviews.customer_id')
          ->where('reviews.product_id', $product->id)
          ->where('reviews.status', 'active')
          ->select('reviews.id', 'reviews.rating', 'reviews.message', 'reviews.created_at', 'users.name', 'users.image')
          ->get();
        return view('admin.reviews', compact('product', 'reviews'));
      }
      $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
          Something went wrong
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>';
      return redirect()->route('admin.product.view')->with('status', $status);
    }












    public function add_compare($product_id = null){
      $compare_data = \Session::get('compare');
      $product = Product::find($product_id);
      if(isset($product)) {
        if (isset($compare_data)) {
          $new_data = [];
          if(count($compare_data) > 2){
            foreach ($compare_data as $key => $item ){
              if($key !== 0){
                $new_data[] = $item;
              }
            }
          }else{
            $new_data = $compare_data;
          }
          $add = false;
          foreach ($new_data as $item) {
            if($item['product_id'] == $product_id){
              $add = true;
            }
          }
          if(!$add) {
            $new_data[] = [
              'product_id' => $product_id
            ];
          }
          \Session::put('compare', $new_data);
        } else {
          $data[] = [
            'product_id' => $product_id
          ];
          \Session::put('compare', $data);
        }
        $compares = \Session::get('compare');
        return response()->json(['compare_count' => count($compares), 'status' => 'success' ]);
      }
    }


    public function remove_from_compare($product_id){
      $compare_data = \Session::get('compare');
      if(isset($compare_data)){
        $new_data = [];
        foreach ($compare_data as $compare) {
          if($compare['product_id'] != $product_id){
            $new_data[] = [
              'product_id'=> $compare['product_id']
            ];
          }
        }
        \Session::put('compare', $new_data);
        return redirect()->back();
      }
    }


    public function compare(){
      $compare_data = \Session::get('compare');
      $com_id1 = -1;
      $com_id2 = -1;
      $com_id3 = -1;
      if(isset($compare_data)) {
        foreach ($compare_data as $key => $item) {
          if ($key == 0) {
            $com_id1 = $item['product_id'];
          }
          if ($key == 1) {
            $com_id2 = $item['product_id'];
          }
          if ($key == 2) {
            $com_id3 = $item['product_id'];
          }
        }
      }
      $com_p1 = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->where('products.id', '=', $com_id1)
        ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
        ->first();
      $com_p2 = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->where('products.id', '=', $com_id2)
        ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
        ->first();
      $com_p3 = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->where('products.id', '=', $com_id3)
        ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name', 'sub_categories.name as sub_category_name')
        ->first();
//      return $com_p1;
      return view('site.compare', compact('com_p1', 'com_p2', 'com_p3'));
    }
}
