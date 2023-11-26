<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BestSellingProduct;
use App\Brand;
use App\Category;
use App\Client;
use App\Feedback;
use App\Models\Policy;
use App\Models\Privacy;
use App\Models\Term;
use App\Product;
use App\ProductHasImage;
use App\Review;
use App\SideBanner;
use App\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
//      $brands = Brand::distinct('name')->get();
//      return $brands;
      $all_products = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
          )
        ->where('products.status', '=', 'active')
        ->where('products.clearing_sale', '=', 'no')
        ->distinct('products.id')
        ->orderBy('products.created_at', 'ASC')
        ->get();

      $clearingsales = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
          )
        ->where('products.clearing_sale', '=', 'yes')
        ->where('products.status', '=', 'active')
        ->distinct('products.id')
        ->orderBy('products.id', 'ASC')
        ->get();
      $special_discounts = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
          )
        ->where('products.clearing_sale', '=', 'special_discount')
        ->where('products.status', '=', 'active')
        ->distinct('products.id')
        ->orderBy('products.id', 'ASC')
        ->get();
      $banners = DB::table('banners')
        ->join('products', 'products.id', '=', 'banners.product_id')
        ->where('banners.status', '=', 'active')
        ->select('banners.id', 'banners.image', 'products.id as product_id', 'products.slug')
        ->orderBy('banners.created_at','DESC')
        ->take(9)
        ->get();
      // return $banners;
//       $bestsels = DB::table('best_selling_products')
//         ->leftJoin('products', 'products.id', '=', 'best_selling_products.product_id')
//         ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
//         ->join('categories', 'categories.id', '=', 'products.category_id')
//         ->join('brands', 'brands.id', '=', 'products.brand_id')
//         ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
//         ->select('products.id', 'products.name', 'products.code', 'products.slug', 'products.quantity', 'products.thumbnail_image',
//           'products.price', 'products.previous_price', DB::raw('SUM(best_selling_products.number_of_product_sale) AS sell'),
//           'products.color', 'sub_categories.name As sub_category_name',
//           'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
//           'brands.name As brand_name', 'brands.id As brand_id',
//           DB::raw('group_concat(product_has_images.image) as image'))
// //        ->where('products.quantity', '>', 0)
//         ->where('products.status', '=', 'active')
//          ->where('products.best_seller', '=', 'true')
//         ->where('categories.name', '!=', 'Package')
//         ->distinct('best_selling_products.product_id')
//         ->orderBy('sell', 'DESC')
//         ->get()->take(10);

        $bestsels = DB::table('products')
         ->where('products.status', '=', 'active')
         ->where('products.best_seller', '=', 'true')
        ->get()->take(10);


        $clients = Client::orderBy('name','ASC')->get();

        // $sideBanner = SideBanner::orderBy('title','ASC')->get();

        $sideBanner = DB::table('side_banners')
                    ->join('products', 'products.id', '=', 'side_banners.product_id')
                    ->where('side_banners.status', '=', 'active')
                    ->select('side_banners.id', 'side_banners.banner_img', 'products.id as product_id', 'products.slug')
                    ->orderBy('side_banners.id','DESC')
                    ->take(2)
                    ->get();

//        $date = date('Y-m-d 00:00:00', strtotime(Carbon::now().'-15 day'));
//        $strdate = strtotime($date);
//        $newproducts = [];
//        foreach ($all_products as $product){
//          if(strtotime($product->created_at) > $strdate){
//            $newproducts[]=$product;
//          }
//        }
        $newproducts = $all_products->take(-30)->toArray();
        $newproducts = array_reverse($newproducts, false);

        $products = $all_products->take(20);
        return view('site.index', compact('products', 'banners', 'bestsels', 'newproducts', 'clearingsales', 'special_discounts','clients','sideBanner'));
    }


  public function product_details($slug = null){
    if($slug != null){
      $product = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.*', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id')
        ->where('products.slug', '=', $slug)
        ->where('products.status', '=', 'active')
        ->first();
//      return $product;
      if(isset($product)) {
        $productImage = ProductHasImage::where('product_id', '=', $product->id)->get();
        $reviews = DB::table('reviews')
          ->leftJoin('users', 'users.id', '=', 'reviews.customer_id')
          ->where('reviews.product_id', $product->id)
          ->where('reviews.status', 'active')
          ->select('reviews.id', 'reviews.rating', 'reviews.message', 'reviews.created_at', 'users.name', 'users.image')
          ->get();
        $num_of_review = count($reviews);
        $avg_review = $reviews->avg('rating');

        return view('site.product_details', compact('product', 'productImage', 'reviews', 'num_of_review', 'avg_review'));
      }
    }
    return redirect()->route('home');
  }


  public function product_search(Request $request){
    if(isset($request->category) && isset($request->sub_category) && isset($request->brand)){
      $products = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
         )
        ->where('categories.slug', (isset($request->category) ? '=' : '!='), (isset($request->category) ? $request->category : null))
        ->where('sub_categories.slug', (isset($request->sub_category) ? '=' : '!='), (isset($request->sub_category) ? $request->sub_category : null))
        ->where('brands.slug', (isset($request->brand) ? '=' : '!='), (isset($request->brand) ? $request->brand : null))
        ->where('products.status', '=', 'active')
        ->distinct('products.id')
        ->orderBy('products.price', 'ASC')
        ->paginate(20)
        ->appends(request()->query());
//      return $products;
      return view('site.products', compact('products', 'request'));
    }
    if(isset($request->category) && isset($request->sub_category)){
      $products = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
          )
        ->where('categories.slug', (isset($request->category) ? '=' : '!='), (isset($request->category) ? $request->category : null))
        ->where('sub_categories.slug', (isset($request->sub_category) ? '=' : '!='), (isset($request->sub_category) ? $request->sub_category : null))
        ->where('products.status', '=', 'active')
        ->distinct('products.id')
        ->orderBy('products.price', 'ASC')
        ->paginate(20)
        ->appends(request()->query());
      return view('site.products', compact('products', 'request'));
    }
    if(isset($request->category)){
      $products = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
        )
        ->where('categories.slug', (isset($request->category) ? '=' : '!='), (isset($request->category) ? $request->category : null))
        ->where('products.status', '=', 'active')
        ->distinct('products.id')
        ->orderBy('products.price', 'ASC')
        ->paginate(20)
        ->appends(request()->query());
      return view('site.products', compact('products', 'request'));
    }
      if(isset($request->subCategory)){
          $products = DB::table('products')
              ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
              ->join('brands', 'brands.id', '=', 'products.brand_id')
              ->join('categories', 'categories.id', '=', 'products.category_id')
              ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
              ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
                  'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
                  'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
                  'brands.name As brand_name', 'brands.id As brand_id',
              )
              ->where('sub_categories.slug', (isset($request->subCategory) ? '=' : '!='), (isset($request->subCategory) ? $request->subCategory : null))
              ->where('products.status', '=', 'active')
              ->distinct('products.id')
              ->orderBy('products.price', 'ASC')
              ->paginate(20)
              ->appends(request()->query());
          return view('site.products', compact('products', 'request'));
      }
    if(isset($request->brand)) {
      $products = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
          )
        ->where('brands.slug', 'LIKE', $request->brand.'%')
        ->where('products.status', '=', 'active')
//        ->where('products.quantity', '>', 0)
        ->distinct('products.id')
        ->orderBy('products.price', 'ASC')
        ->paginate(20)
        ->appends(request()->query());
//      return $products;
      return view('site.products', compact('products', 'request'));
    }
    if(isset($request->search)) {
      $products = DB::table('products')
        ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
          'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
          'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
          'brands.name As brand_name', 'brands.id As brand_id',
          )
        ->where('products.name', 'like', '%' . $request->search . '%')
//        ->orWhere('sub_categories.name', 'like', '%' . $request->search . '%')
//        ->orWhere('products.code', 'like', '%' . $request->search . '%')

        ->where('products.status', '=', 'active')
        ->distinct('products.id')
        ->orderBy('products.price', 'ASC')
        ->paginate(20)
        ->appends(request()->query());
      if (isset($request->search_by)){
        if($request->search_by == 'product') {
          $products = DB::table('products')
            ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
            ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
              'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
              'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
              'brands.name As brand_name', 'brands.id As brand_id',
              )
            ->where('products.slug', $request->search)
            ->where('products.status', '=', 'active')
            ->distinct('products.id')
            ->orderBy('products.price', 'ASC')
            ->paginate(20)
            ->appends(request()->query());
        }
        if($request->search_by == 'subcategory') {
          $products = DB::table('products')
            ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
            ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
              'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
              'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
              'brands.name As brand_name', 'brands.id As brand_id',
              )
            ->where('sub_categories.slug', $request->search)
            ->where('products.status', '=', 'active')
            ->distinct('products.id')
            ->orderBy('products.price', 'ASC')
            ->paginate(20)
            ->appends(request()->query());
        }
        if($request->search_by == 'brand') {
          $products = DB::table('products')
            ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
            ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
              'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
              'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
              'brands.name As brand_name', 'brands.id As brand_id',
              )
            ->where('brands.slug', 'LIKE', $request->search.'%')
            ->where('products.status', '=', 'active')
            ->distinct('products.id')
            ->orderBy('products.price', 'ASC')
            ->paginate(20)
            ->appends(request()->query());
//          return $products;
        }
      }
      return view('site.products', compact('products', 'request'));
    }else{
          $products = DB::table('products')
              ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
              ->join('brands', 'brands.id', '=', 'products.brand_id')
              ->join('categories', 'categories.id', '=', 'products.category_id')
              ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
              ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
                  'products.code', 'products.previous_price', 'products.price', 'sub_categories.name As sub_category_name',
                  'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
                  'brands.name As brand_name', 'brands.id As brand_id',
              )
              ->where('products.status', '=', 'active')
              ->distinct('products.id')
              ->orderBy('products.price', 'ASC')
              ->paginate(20);
          return view('site.products', compact('products', 'request'));
      }
  }


  public function ajax_search_product_name(Request $request){
    $key = $request->post('key');
    if(isset($key)){
      $products = DB::table('products')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
        ->where('products.name', 'like', '%'.$key.'%')
        ->where('products.status', '=', 'active')
        ->select('products.id', 'products.name', 'products.slug', 'products.price', 'products.thumbnail_image as image')
        ->distinct('products.id')
        ->orderBy('products.price', 'ASC')
        ->get();
      $sub_categories = SubCategory::where('name', 'like', '%'.$key.'%')
        ->select('id', 'name', 'slug')
        ->distinct('name')
        ->orderBy('id', 'ASC')
        ->get();
      $brands = Brand::where('name', 'like', '%'.$key.'%')
        ->select('id', 'name', 'slug')
        ->distinct('name')
        ->orderBy('id', 'ASC')
        ->get();
      return response()->json(['products' => $products, 'sub_categories' => $sub_categories, 'brands' => $brands, 'status' => 'success' ]);
    }
  }


  public function aboutus(){
    return view('site.aboutus');
  }

  public function contactus(){
    return view('site.contactus');
  }

  public function returnRefund (){
    $policy = Policy::where('type','policy')->first();
    return view('site.return_refund', compact('policy') );
  }
  public function returnRefundBN (){

    $policy = Policy::where('type','policy')->first();
    return view('site.return_refundBN', compact('policy') );
  }

  public function privacy_policy (){
    $privacy = Privacy::where('type','privacy')->first();
    return view('site.privacy_policy', compact('privacy') );
  }
  public function privacy_policyBN (){
    $policy = Policy::where('type','policy')->first();
    return view('site.privacy_policyBN', compact('policy') );
  }

  public function terms_and_conditions (){
    $term = Term::where('type', 'term')->first();
    return view('site.terms_and_conditions', compact('term'));
  }


  public function send_feedback(Request $request){
    if($request->isMethod('POST')){
      $data = $request->all();

      $validator = Validator::make($data, [
        'name' => 'required',
        'mobile_no' => 'required|min:11|numeric',
        'email' => 'required|email',
        'message' => 'required'
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try{
        $feedback = new Feedback();
        $feedback->name = $data['name'];
        $feedback->email = $data['email'];
        $feedback->mobile_no = $data['mobile_no'];
        $feedback->message = $data['message'];
        if($feedback->save()){
          return 'success';
        }
      }catch (QueryException $e){

      }
    }
  }


  public function new_arrivals(){
    $all_products = DB::table('products')
      ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
      ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
        'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
        'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
        'brands.name As brand_name', 'brands.id As brand_id',
        )
        // DB::raw('group_concat(product_has_images.image) as image'))
      ->where('products.status', '=', 'active')
      ->where('products.clearing_sale', '=', 'no')
      ->distinct('products.id')
      ->orderBy('products.created_at', 'ASC')
      ->get();
    $_newproducts = $all_products->take(-30)->toArray();
    $_newproducts = array_reverse($_newproducts, false);
    $ides = array();
    foreach ($_newproducts as $val){
      $ides[] = $val->id;
    }

    $newproducts = DB::table('products')
      ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
      ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
        'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
        'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
        'brands.name As brand_name', 'brands.id As brand_id',
        // DB::raw('group_concat(product_has_images.image) as image'))
        )
      ->where('products.status', '=', 'active')
      ->where('products.clearing_sale', '=', 'no')
      ->whereIn('products.id', $ides)
      ->distinct('products.id')
      ->orderBy('products.created_at', 'DESC')
      ->paginate(12);
//    return $newproducts;
    return view('site.new_arrivals', compact('newproducts'));
  }

  public function special_discount(){
//      return "hello";
    $special_discounts = DB::table('products')
      ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
      ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
        'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
        'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
        'brands.name As brand_name', 'brands.id As brand_id',
        DB::raw('group_concat(product_has_images.image) as image'))
      ->where('products.clearing_sale', '=', 'special_discount')
      ->where('products.status', '=', 'active')
      ->distinct('products.id')
      ->orderBy('products.id', 'ASC')
      ->paginate(12);
      return view('site.special_discount', compact('special_discounts'));
  }

  public function clearance_sale(){
//      return "hello";
    $clearingsales = DB::table('products')
      ->leftJoin('product_has_images', 'product_has_images.product_id', '=', 'products.id')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
      ->select('products.id', 'products.name', 'products.slug', 'products.thumbnail_image', 'products.quantity',
        'products.code', 'products.previous_price', 'products.price', 'products.color', 'products.created_at', 'sub_categories.name As sub_category_name',
        'sub_categories.id As sub_category_id', 'categories.name As category_name', 'categories.id As category_id',
        'brands.name As brand_name', 'brands.id As brand_id',
        DB::raw('group_concat(product_has_images.image) as image'))
      ->where('products.clearing_sale', '=', 'yes')
      ->where('products.status', '=', 'active')
      ->distinct('products.id')
      ->orderBy('products.id', 'ASC')
      ->paginate(12);
      return view('site.clearance_sale', compact('clearingsales'));
  }

  public function subcatApi($slug)
{

    $cat= Category::where('slug',$slug)->first();
     $data['subcategory'] = SubCategory::where('category_id',$cat->id)->where('status', '=', 'active')->select('slug', 'category_id', 'name')->get();
    return response()->json($data);
}
    public function brandApi($slug)
    {

        $sub= SubCategory::where('slug',$slug)->first();
//         $brand = Brand::where('slug',$slug)->first();
         $data['brand'] = $sub->brands;
    return response()->json($data);

    }


}
