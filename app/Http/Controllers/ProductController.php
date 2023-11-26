<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
//use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\File;
use Validator;
use Image;
use App\ProductHasImage;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller{

  /**
   * admin can add product
   * @param Request $request
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
//   public function add_product(Request $request)  {
//     $brands = Brand::where('status', '=', 'active')->get();
//     $categories = Category::where('status', '=', 'active')->get();
//     $sub_categories = SubCategory::where('status', '=', 'active')->get();
//     if($request->isMethod("POST")){
//       $data = $request->all();
// //            return $data;
//       $validator = Validator::make($data, [
//         'name' => 'required',
//         'code' => 'required',
//         'category_id' => 'required|numeric',
//         'subcategory_id' => 'required|numeric',
//         'brand_id' => 'required|numeric',
//         'price' => 'nullable|numeric',
//         'quantity' => 'required|numeric',
//         'description' => 'required',
//         'clearing_sale' => 'required',
//         'status' => 'required',
//         'thumbnail_image' => 'required|mimes:jpeg,png,jpg,webp|max:800',
//         'image.*' => 'nullable|mimes:jpeg,png,jpg,webp|max:800'
//       ]);

//       if($validator->fails()){
//         return redirect()->back()
//           ->withErrors($validator)
//           ->withInput();
//       }

//       if ($request->hasFile('thumbnail_image')) {
// //          $image2 = $request->file('thumbnail_image');
// //          $name2 = time() . '.' . $image2->getClientOriginalExtension();
// //          $destinationPath2 = public_path($path2);
// //          $image2->move($destinationPath2, $name2);
//         $path2 = 'product_images/';
//         $image2 = $request->file('thumbnail_image');
//         $name2 = time().'.'.$image2->getClientOriginalExtension();
//         $img = Image::make($image2->path());
//         $img->resize(600, 600)->save(public_path('/product_images/'.$name2));
//       }

//       $images = array();
//       if ($request->hasFile('image')) {
//           if ($files = $request->file('image')) {
//             $i = 0;
//             $m = 0;
//             foreach ($files as $file) {
// //                  return $request;
//               $image = ['image' => $file];

//               $i++;
//               $path = 'product_images/';
//               $name = time().$i.'.'.$file->getClientOriginalExtension();
//               $img = Image::make($file->path());
//               $img->resize(600, 600)->save(public_path('/product_images/'.$name));
//               $images[] = $path . $name;
//             }
//           }
//       }

//       $thumbnail_image = '';
//       if (isset($name2)) {
//         $thumbnail_image = $path2 . $name2;
//       } else {
//         $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//                           Thumbnail image missing.
//                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                                 <span aria-hidden="true">&times;</span>
//                               </button>
//                         </div>';
//         return redirect()->back()->with('status', $status)->withInput();
//       }
// //  has color
//       $color = '';
//       if(isset($data['color'])) {
//         foreach ($data['color'] As $key => $value) {
//           if ($color == '') {
//             $color = $value;
//           } else {
//             $color = $color . '|' . $value;
//           }
//         }
//       }
// //  return $color;
//       $product = new Product();
//       $product->name = $data['name'];
//       $product->code = $data['code'];
//       $product->brand_id = $data['brand_id'];
//       $product->category_id = $data['category_id'];
//       $product->sub_category_id = $data['subcategory_id'];
//       if (!($data['weight'] == null || $data['weight'] == "")) {
//         $product->weight = $data['weight'];
//       }
//       if (!($data['dimensions'] == null || $data['dimensions'] == "")) {
//         $product->dimensions = $data['dimensions'];
//       }
//       if (!($data['include'] == null || $data['include'] == "")) {
//         $product->include = $data['include'];
//       }
//       if (!($data['guarantee'] == null || $data['guarantee'] == "")) {
//         $product->guarantee = $data['guarantee'];
//       }
//       if (!($data['made_in'] == null || $data['made_in'] == "")) {
//         $product->made_in = $data['made_in'];
//       }
//       if (!($data['previous_price'] == null || $data['previous_price'] == "")) {
//         $product->previous_price = $data['previous_price'];
//       }

//       $product->price = $data['price'];
//       if($color != '#000000'){
//         $product->color = $color;
//       };
//       $product->quantity = $data['quantity'];

//       $product->description = $data['description'];
//       $product->clearing_sale = $data['clearing_sale'];

//       $product->thumbnail_image = $thumbnail_image;
//       $product->status = strtolower($data['status']);

//       if($product->save()){
//         foreach ($images As $image){
//           $product_image = new ProductHasImage();
//           $product_image->product_id = $product->id;
//           $product_image->image = $image;
//           $product_image->save();
//         }
//         $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
//             <strong>Congratulation!!! </strong>Product added successfully.
//                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                   <span aria-hidden="true">&times;</span>
//                 </button>
//           </div>';
//         return redirect()->back()->with('status', $status);
//       }
//       $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//           <strong>Sorry!!! </strong>Something went wrong.
//               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                 <span aria-hidden="true">&times;</span>
//               </button>
//         </div>';
//       return redirect()->back()->with('status', $status)->withInput();
//     }
//     return view('admin.product.add', compact('categories', 'sub_categories', 'brands'));
//   }

     public function add_product(Request $request)  {
       $brands = Brand::where('status', '=', 'active')->get();
       $categories = Category::where('status', '=', 'active')->get();
       $sub_categories = SubCategory::where('status', '=', 'active')->get();
       if($request->isMethod("POST")){
         $data = $request->all();
//               return $data;
         $validator = Validator::make($data, [
           'name' => 'required',
           'code' => 'required',
           'category_id' => 'required|numeric',
           'subcategory_id' => 'required|numeric',
           'brand_id' => 'required|numeric',
           'price' => 'nullable|numeric',
           'quantity' => 'required|numeric|min:0',
           'description' => 'required',
           'specification' => 'required',
           'clearing_sale' => 'required',
           'status' => 'required',
           'thumbnail_image' => 'required|mimes:jpeg,png,jpg,webp|max:800',
           'image.*' => 'nullable|mimes:jpeg,png,jpg,webp|max:800',
           'best_seller' => 'required',
           'meta_title' => 'nullable',
           'meta_description' => 'nullable',
           'meta_tags' => 'nullable',
         ]);

         if($validator->fails()){
           return redirect()->back()
             ->withErrors($validator)
             ->withInput();
         }

         if ($request->hasFile('thumbnail_image')) {
   //          $image2 = $request->file('thumbnail_image');
   //          $name2 = time() . '.' . $image2->getClientOriginalExtension();
   //          $destinationPath2 = public_path($path2);
   //          $image2->move($destinationPath2, $name2);
           $path2 = '/product_images/';
           $destinationPath2 = public_path($path2);
           if(!File::isDirectory($destinationPath2)){
               File::makeDirectory($destinationPath2, 0777, true, true);
           }
           $image2 = $request->file('thumbnail_image');
           $name2 = time().'.'.$image2->getClientOriginalExtension();
           $img = Image::make($image2->path());
           $img->resize(600, 600)->save(public_path('/product_images/'.$name2));
         }

         $images = array();
         if ($request->hasFile('image')) {
             if ($files = $request->file('image')) {
               $i = 0;
               $m = 0;
               foreach ($files as $file) {
   //                  return $request;
                 $image = ['image' => $file];

                 $i++;
                 $path = '/product_images/';
                 $name = time().$i.'.'.$file->getClientOriginalExtension();
                 $img = Image::make($file->path());
                 $img->resize(600, 600)->save(public_path('/product_images/'.$name));
                 $images[] = $path . $name;
               }
             }
         }

         $thumbnail_image = '';
         if (isset($name2)) {
           $thumbnail_image = $path2 . $name2;
         } else {
           $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                             Thumbnail image missing.
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                           </div>';
           return redirect()->back()->with('status', $status)->withInput();
         }
   //  has color
         $color = '';
         if(isset($data['color'])) {
           foreach ($data['color'] As $key => $value) {
             if ($color == '') {
               $color = $value;
             } else {
               $color = $color . '|' . $value;
             }
           }
         }
   //  return $color;
         $product = new Product();
         $product->name = $data['name'];
         $product->code = $data['code'];
         $product->brand_id = $data['brand_id'];
         $product->category_id = $data['category_id'];
         $product->sub_category_id = $data['subcategory_id'];
         if (!($data['weight'] == null || $data['weight'] == "")) {
           $product->weight = $data['weight'];
         }
         if (!($data['dimensions'] == null || $data['dimensions'] == "")) {
           $product->dimensions = $data['dimensions'];
         }
         if (!($data['include'] == null || $data['include'] == "")) {
           $product->include = $data['include'];
         }
         if (!($data['guarantee'] == null || $data['guarantee'] == "")) {
           $product->guarantee = $data['guarantee'];
         }
         if (!($data['made_in'] == null || $data['made_in'] == "")) {
           $product->made_in = $data['made_in'];
         }
         if (!($data['previous_price'] == null || $data['previous_price'] == "")) {
           $product->previous_price = $data['previous_price'];
         }
         if (!($data['meta_title'] == null || $data['meta_title'] == "")) {
           $product->meta_title = $data['meta_title'];
         }
         if (!($data['meta_description'] == null || $data['meta_description'] == "")) {
           $product->meta_description = $data['meta_description'];
         }
         if (!($data['meta_tags'] == null || $data['meta_tags'] == "")) {
           $product->meta_tags = $data['meta_tags'];
         }


         $product->price = $data['price'];
         if($color != '#000000'){
           $product->color = $color;
         };
         $product->quantity = $data['quantity'];

         $product->description = $data['description'];
         $product->specification = $data['specification'];
         $product->clearing_sale = $data['clearing_sale'];

         $product->thumbnail_image = $thumbnail_image;
         $product->status = strtolower($data['status']);
         $product->best_seller = $data['best_seller'];

         if($product->save()){
           foreach ($images As $image){
             $product_image = new ProductHasImage();
             $product_image->product_id = $product->id;
             $product_image->image = $image;
             $product_image->save();
           }
           $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Congratulation!!! </strong>Product added successfully.
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
             </div>';
           return redirect()->back()->with('status', $status);
         }
         $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Sorry!!! </strong>Something went wrong.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
           </div>';
         return redirect()->back()->with('status', $status)->withInput();
       }
       return view('admin.product.add', compact('categories', 'sub_categories', 'brands'));
     }
  /**
   * admin can view all product
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function view_product() {
    $products = DB::table('products')
      ->join('brands', 'brands.id', '=', 'products.brand_id')
      ->join('categories', 'categories.id', '=', 'products.category_id')
      ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
//      ->where('categories.status', '=', 'active')
      ->where('sub_categories.status', '=', 'active')
      ->select('products.id', 'products.name', 'products.thumbnail_image', 'products.price', 'products.quantity', 'products.slug', 'brands.name as brand', 'categories.name as category', 'sub_categories.name as sub_category')
      ->get();
    return view('admin.product.view', compact('products'));
  }


  /**
   * admin can edit product
   * @param Request $request
   * @param null $slug
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
//   public function edit_product(Request $request, $slug = null){
//     if($slug != null){
//       $brands = Brand::where('status', '=', 'active')->get();
//       $categories = Category::where('status', '=', 'active')->get();
//       $sub_categories = SubCategory::where('status', '=', 'active')->get();
//       $product = Product::where('slug', '=', $slug)->first();
//       $images = [];
// //      return $product;
//       if(isset($product)){
//         $images = ProductHasImage::where('product_id', '=', $product->id)->get();
// //        return $images;
//         if($request->isMethod("POST")){
//           try{
//             $data = $request->all();
// //              return $data;
//             $validator = Validator::make($data, [
//               'name' => 'required',
//               'code' => 'required',
//               'brand_id' => 'required|numeric',
//               'category_id' => 'required|numeric',
//               'subcategory_id' => 'required|numeric',
//               'price' => 'nullable|numeric',
//               'quantity' => 'required|numeric',
//               'description' => 'required',
//               'clearing_sale' => 'required',
//               'status' => 'required',
//               'thumbnail_image' => 'nullable|mimes:jpeg,png,jpg,webp|max:800',
//               'image.*' => 'nullable|mimes:jpeg,png,jpg,webp|max:800'
//             ]);

//             if($validator->fails()){
//               return redirect()->back()
//                 ->withErrors($validator)
//                 ->withInput();
//             }

//             if ($request->hasFile('thumbnail_image')) {
// //                $image2 = $request->file('thumbnail_image');
// //                $name2 = time() . '.' . $image2->getClientOriginalExtension();
// //                $path2 = 'product_images/';
// //                $destinationPath2 = public_path($path2);
// //                $image2->move($destinationPath2, $name2);
//               $path2 = 'product_images/';
//               $image2 = $request->file('thumbnail_image');
//               $name2 = time().'.'.$image2->getClientOriginalExtension();
//               $img = Image::make($image2->path());
//               $img->resize(600, 600)->save(public_path('/product_images/'.$name2));
//             }

//             $images = array();
//             if ($request->hasFile('image')) {
//                 if ($files = $request->file('image')) {
//                   $i = 0;
//                   $m = 0;
//                   foreach ($files as $file) {
// //                  return $request;
//                     $image = ['image' => $file];

//                     $i++;
// //                    $name = time() . $i . '.' . $file->getClientOriginalExtension();
// //                    $path = 'product_images/';
// //                    $destinationPath = public_path($path);
// //                    $file->move($destinationPath, $name);
// //                    $images[] = $path . $name;

//                     $path = 'product_images/';
//                     $name = time().$i.'.'.$file->getClientOriginalExtension();
//                     $img = Image::make($file->path());
//                     $img->resize(600, 600)->save(public_path('/product_images/'.$name));
//                     $images[] = $path . $name;
//                   }
//                 }
//             }


//             $thumbnail_image = '';
//             if (isset($name2)) {
//               $thumbnail_image = $path2 . $name2;
//             }
//             /*else {
//               $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//                             Thumbnail image missing.
//                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                                   <span aria-hidden="true">&times;</span>
//                                 </button>
//                           </div>';
//               return redirect()->back()->with('status', $status)->withInput();
//             }*/
//   //  has color
//             $color = '';
//             if(isset($data['color'])) {
//               foreach ($data['color'] As $key => $value) {
//                 if($color == ''){
//                   $color = $value;
//                 }else{
//                   $color = $color.'|'.$value;
//                 }
//               }
//             }

//             $update_array = [
//               'name' => $data['name'],
//               'code' => $data['code'],
//               'brand_id' => $data['brand_id'],
//               'category_id' => $data['category_id'],
//               'sub_category_id' => $data['subcategory_id'],
//               'price' => $data['price'],
//               'quantity' => $data['quantity'],
//               'description' => $data['description'],
//               'status' => strtolower($data['status']),
//             ];
// //            return $update_array;
//             if($thumbnail_image != '') {
//               $update_array['thumbnail_image'] = $thumbnail_image;
//             }
//             if (!($data['weight'] == null || $data['weight'] == "")) {
//               $update_array['weight'] = $data['weight'];
//             }
//             if (!($data['dimensions'] == null || $data['dimensions'] == "")) {
//               $update_array['dimensions'] = $data['dimensions'];
//             }
//             if (!($data['include'] == null || $data['include'] == "")) {
//               $update_array['include'] = $data['include'];
//             }
//             if (!($data['guarantee'] == null || $data['guarantee'] == "")) {
//               $update_array['guarantee'] = $data['guarantee'];
//             }
//             if (!($data['made_in'] == null || $data['made_in'] == "")) {
//               $update_array['made_in'] = $data['made_in'];
//             }
//             if (!($data['previous_price'] == null || $data['previous_price'] == "")) {
//               $update_array['previous_price'] = $data['previous_price'];
//             }
//             $update_array['clearing_sale'] = $data['clearing_sale'];

//             if($color != '#000000'){
//               $update_array['color'] = $color;
//             };
// //            return $update_array;
//             Product::find($product->id)->update(['slug'=>null]);
//             if(Product::find($product->id)->update($update_array)){
// //              return Product::find($product->id);
//               foreach ($images As $image){
//                 $product_image = new ProductHasImage();
//                 $product_image->product_id = $product->id;
//                 $product_image->image = $image;
//                 $product_image->save();
//               }
//               $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
//                 <strong>Congratulation!!! </strong>Product successfully updated.
//                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                     <span aria-hidden="true">&times;</span>
//                   </button>
//                 </div>';
//               return redirect()->route('admin.product.view')->with('status', $status);
//             }
//             $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//               <strong>Sorry!!! </strong>Something went wrong.
//                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                   <span aria-hidden="true">&times;</span>
//                 </button>
//               </div>';
//             return redirect()->back()->with('status', $status)->withInput();
//           }catch (QueryException $e){
//             $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//                       <strong>Sorry!!! </strong>Something Went wrong.
//                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                             <span aria-hidden="true">&times;</span>
//                           </button>
//                     </div>';
//             return redirect()->back()->with('status', $status)->withInput();
//           }
//         }
//         return view('admin.product.edit', compact('categories', 'sub_categories', 'brands', 'product', 'images'));
//       }
//     }
//     return redirect()->route('admin.product.view');
//   }

    public function edit_product(Request $request, $slug = null){

      if($slug != null){
        $brands = Brand::where('status', '=', 'active')->get();
        $categories = Category::where('status', '=', 'active')->get();
        $sub_categories = SubCategory::where('status', '=', 'active')->get();
        $product = Product::where('slug', '=', $slug)->first();
        $images = [];
//        return $product;
        if(isset($product)){
          $images = ProductHasImage::where('product_id', '=', $product->id)->get();
  //        return $images;
          if($request->isMethod("POST")){
            try{
              $data = $request->all();
  //              return $data;
              $validator = Validator::make($data, [
                'name' => 'required',
                'code' => 'required',
                'brand_id' => 'required|numeric',
                'category_id' => 'required|numeric',
                'subcategory_id' => 'required|numeric',
                'price' => 'nullable|numeric',
                'quantity' => 'required|numeric',
                'description' => 'required',
                'specification' => 'required',
                'clearing_sale' => 'required',
                'status' => 'required',
                'thumbnail_image' => 'nullable|mimes:jpeg,png,jpg,webp|max:800',
                'image.*' => 'nullable|mimes:jpeg,png,jpg,webp|max:800',
                'best_seller' => 'required',
                'meta_title' => 'nullable',
                'meta_description' => 'nullable',
                'meta_tags' => 'nullable'
              ]);

              if($validator->fails()){
                return redirect()->back()
                  ->withErrors($validator)
                  ->withInput();
              }

              if ($request->hasFile('thumbnail_image')) {
  //                $image2 = $request->file('thumbnail_image');
  //                $name2 = time() . '.' . $image2->getClientOriginalExtension();
  //                $path2 = 'product_images/';
  //                $destinationPath2 = public_path($path2);
  //                $image2->move($destinationPath2, $name2);
                $path2 = 'product_images/';
                $image2 = $request->file('thumbnail_image');
                $name2 = time().'.'.$image2->getClientOriginalExtension();
                $img = Image::make($image2->path());
                $img->resize(600, 600)->save(public_path('product_images/'.$name2));
              }

              $images = array();
              if ($request->image) {
                  if ($files = $request->image) {
                    $i = 0;
                    $m = 0;
                    foreach ($files as $file) {
  //                  return $request;
                      $image = ['image' => $file];

                      $i++;
  //                    $name = time() . $i . '.' . $file->getClientOriginalExtension();
  //                    $path = 'product_images/';
  //                    $destinationPath = public_path($path);
  //                    $file->move($destinationPath, $name);
  //                    $images[] = $path . $name;

                      $path = 'product_images/';
                      $name = time().$i.'.'.$file->getClientOriginalExtension();
                      $img = Image::make($file->path());
                      $img->resize(600, 600)->save(public_path('product_images/'.$name));
                      $images[] = $path . $name;
                    }
                  }
              }


              $thumbnail_image = '';
              if (isset($name2)) {
                $thumbnail_image = $path2 . $name2;
              }
              /*else {
                $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              Thumbnail image missing.
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>';
                return redirect()->back()->with('status', $status)->withInput();
              }*/
    //  has color
              $color = '';
              if(isset($data['color'])) {
                foreach ($data['color'] As $key => $value) {
                  if($color == ''){
                    $color = $value;
                  }else{
                    $color = $color.'|'.$value;
                  }
                }
              }

              $update_array = [
                'name' => $data['name'],
                'code' => $data['code'],
                'brand_id' => $data['brand_id'],
                'category_id' => $data['category_id'],
                'sub_category_id' => $data['subcategory_id'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'description' => $data['description'],
                'specification' => $data['specification'],
                'status' => strtolower($data['status']),
                'best_seller' => $data['best_seller'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_tags' => $data['meta_tags'],
              ];
  //            return $update_array;
              if($thumbnail_image != '') {
                $update_array['thumbnail_image'] = $thumbnail_image;
              }
              if (!($data['weight'] == null || $data['weight'] == "")) {
                $update_array['weight'] = $data['weight'];
              }
              if (!($data['dimensions'] == null || $data['dimensions'] == "")) {
                $update_array['dimensions'] = $data['dimensions'];
              }
              if (!($data['include'] == null || $data['include'] == "")) {
                $update_array['include'] = $data['include'];
              }
              if (!($data['guarantee'] == null || $data['guarantee'] == "")) {
                $update_array['guarantee'] = $data['guarantee'];
              }
              if (!($data['made_in'] == null || $data['made_in'] == "")) {
                $update_array['made_in'] = $data['made_in'];
              }
              if (!($data['previous_price'] == null || $data['previous_price'] == "")) {
                $update_array['previous_price'] = $data['previous_price'];
              }
                if (!($data['meta_title'] == null || $data['meta_title'] == "")) {
                    $product->meta_title = $data['meta_title'];
                }
                if (!($data['meta_description'] == null || $data['meta_description'] == "")) {
                    $product->meta_description = $data['meta_description'];
                }
                if (!($data['meta_tags'] == null || $data['meta_tags'] == "")) {
                    $product->meta_tags = $data['meta_tags'];
                }
              $update_array['clearing_sale'] = $data['clearing_sale'];

              if($color != '#000000'){
                $update_array['color'] = $color;
              };
  //            return $update_array;
              Product::find($product->id)->update(['slug'=>null]);
              if(Product::find($product->id)->update($update_array)){
  //              return Product::find($product->id);
                foreach ($images As $image){
                  $product_image = new ProductHasImage();
                  $product_image->product_id = $product->id;
                  $product_image->image = $image;
                  $product_image->save();
                }
                $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Congratulation!!! </strong>Product successfully updated.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                return redirect()->route('admin.product.view')->with('status', $status);
              }
              $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Sorry!!! </strong>Something went wrong.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
              return redirect()->back()->with('status', $status)->withInput();
            }catch (QueryException $e){
              $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Sorry!!! </strong>Something Went wrong.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                      </div>';
              return redirect()->back()->with('status', $status)->withInput();
            }
          }
          return view('admin.product.edit', compact('categories', 'sub_categories', 'brands', 'product', 'images'));
        }
      }
      return redirect()->route('admin.product.view');
    }

  /**
   * admin can delete product
   * @param Request $request
   * @return string
   */
  public function delete_product(Request $request) {
    if($request->isMethod('DELETE')){
      $id = $request->post('id');
      $product = Product::find($id);
      if($product->delete()){
        $old_image_path1 = public_path($product->thumbnail_image);
        if (file_exists($old_image_path1)) {
          @unlink($old_image_path1);
        }
        $product_has_image = ProductHasImage::where('product_id', '=', $id)->get();
        foreach ($product_has_image as $value){
          if(ProductHasImage::find($value->id)->delete()) {
            $old_image_path = public_path($value->image);
            if (file_exists($old_image_path)) {
              @unlink($old_image_path);
            }
          }
        }
        return 'success';
      }
    }
  }


  /**
   * admin can delete product images
   * @param Request $request
   * @return string
   */
  public function delete_product_image(Request $request) {
    if($request->isMethod('POST')){
      $id = $request->post('id');
      $product_image = ProductHasImage::find($id);
      if($product_image->delete()){
        $old_image_path1 = public_path($product_image->image);
        if (file_exists($old_image_path1)) {
          @unlink($old_image_path1);
        }
        return 'success';
      }
    }
  }
}
