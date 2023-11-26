<?php

namespace App\Http\Controllers;

use App\Brand;
use App\SubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

  /**
   * admin can add new brand
   * @param Request $request
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function add_brand(Request $request){
    $categories = Category::where('status', '=', 'active')->get();
    $sub_categories = SubCategory::where('status', '=', 'active')->get();
     if($request->isMethod("POST")){
       $data = $request->all();
       $validator = Validator::make($data,[
         'name' => 'required',

         'brand_image' => 'mimes:jpeg,png,jpg,webp|max:100'
       ]);

       if ($validator->fails()) {
         return redirect()->back()
           ->withErrors($validator)
           ->withInput();
       }
       try {
         if ($request->hasFile('brand_image')) {
           $image = $request->file('brand_image');
           $name = time() . '.' . $image->getClientOriginalExtension();
           $path = 'brand_images/';
           $destinationPath = public_path($path);
           $image->move($destinationPath, $name);
         }
         $brand_image = '';
         if (isset($name)) {
           $brand_image = $path . $name;
         }else{
           $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                          Brand image missing.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>';
           return redirect()->back()->with('status', $status)->withInput();
         }

         $brand = new Brand();
         $brand->name = $data['name'];
         $brand->image = $brand_image;
         if($brand->save()) {
           $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Brand added successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
           return redirect()->back()->with('status', $status);
         }
         $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Sorry!! </strong>Something Went wrong.
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
     return view('admin.brand.add', compact('categories', 'sub_categories'));
  }


  /**
   * @return mixed
   */
  public function view_brand(){
    $brands = Brand::select('id', 'name', 'slug', 'image')->get();
    return view('admin.brand.view', compact('brands'));
  }

  /**
   * @param Request $request
   * @param null $slug
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function edit_brand(Request $request, $slug = null){
    if($slug != null){
      $brand = Brand::where('slug', '=', $slug)->first();
      if(isset($brand)){
        $categories = Category::where('status', '=', 'active')->get();
        $sub_categories = SubCategory::where('status', '=', 'active')->get();
        if($request->isMethod("POST")){
          $data = $request->all();
          $validator = Validator::make($data,[
            'name' => 'required',

            'brand_image' => 'nullable|mimes:jpeg,png,jpg,webp|max:100'
          ]);

          if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
          try {

            if ($request->hasFile('brand_image')) {
              $image = $request->file('brand_image');
              $name = time() . '.' . $image->getClientOriginalExtension();
              $path = 'brand_images/';
              $destinationPath = public_path($path);
              $image->move($destinationPath, $name);
            }
            $brand_image = '';
            if (isset($name)) {
              $brand_image = $path . $name;
            }

            $updateData = [
              'name' => $data['name'],
            ];
            if($brand_image!=''){
              $updateData['image'] = $brand_image;
            }

            Brand::find($brand->id)->update(['slug'=>null]);
            $brandUpdate = Brand::find($brand->id)->update($updateData);
            if($brandUpdate) {
              if($brand_image!='') {
                $old_image_path1 = public_path($brand->image);
                if (file_exists($old_image_path1)) {
                  @unlink($old_image_path1);
                }
              }
              $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Brand Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
              return redirect()->route('admin.brand.view')->with('status', $status);
            }
            $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Sorry!! </strong>Something Went wrong.
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
        return view('admin.brand.edit', compact('brand', 'categories', 'sub_categories'));
      }
    }
    return redirect()->route('admin.category.view');
  }


  /**
   * admin can delete brand
   * @param Request $request
   * @return string
   */
  public function delete_brand(Request $request){
    if($request->isMethod('DELETE')){
      $id = $request->post('id');
      $brand = Brand::find($id);
      if($brand->delete()){
        $this->__delete_photo($brand->image);
        return 'success';
      }
    }
  }




  /**
   * admin can add new category
   * @param Request $request
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function add_category(Request $request){
     if($request->isMethod("POST")){
       $data = $request->all();
       $validator = Validator::make($data,[
         'name' => 'required',
         'category_image' => 'mimes:jpeg,png,jpg,webp|max:50'
       ]);

       if ($validator->fails()) {
         return redirect()->back()
           ->withErrors($validator)
           ->withInput();
       }
       try {

         if ($request->hasFile('category_image')) {
           $image = $request->file('category_image');
           $name = time() . '.' . $image->getClientOriginalExtension();
           $path = 'category_images/';
           $destinationPath = public_path($path);
           $image->move($destinationPath, $name);
         }
         $category_image = '';
         if (isset($name)) {
           $category_image = $path . $name;
         }else{
           $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                          Category image missing.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>';
           return redirect()->back()->with('status', $status)->withInput();
         }

         $category = new Category();
         $category->name = $data['name'];
         $category->image = $category_image;
         if($category->save()) {
           $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Category added successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
           return redirect()->back()->with('status', $status);
         }
         $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Sorry!! </strong>Something Went wrong.
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
     return view('admin.category.add');
  }


  /**
   * @return mixed
   */
  public function view_category(){
    $categories = Category::where('status', '=', 'active')->select('id', 'name', 'image', 'slug')->get();
    return view('admin.category.view', compact('categories'));
  }

  /**
   * @param Request $request
   * @param null $slug
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function edit_category(Request $request, $slug = null){
    if($slug != null){
      $category = Category::where('slug', '=', $slug)->first();
      if(isset($category)){
        if($request->isMethod("POST")){
          $data = $request->all();
          $validator = Validator::make($data,[
            'name' => 'required',
            'category_image' => 'nullable|mimes:jpeg,png,jpg,webp|max:50'
          ]);

          if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
          try {

            if ($request->hasFile('category_image')) {
              $image = $request->file('category_image');
              $name = time() . '.' . $image->getClientOriginalExtension();
              $path = 'category_images/';
              $destinationPath = public_path($path);
              $image->move($destinationPath, $name);
            }
            $category_image = '';
            if (isset($name)) {
              $category_image = $path . $name;
            }
            $updateData = [
              'name' => $data['name']
            ];

            if($category_image != ''){
              $updateData['image'] = $category_image;
            }
            Category::find($category->id)->update(['slug'=>null]);
            $categoryUpdate = Category::find($category->id)->update($updateData);
            if($categoryUpdate) {
              if($category_image !='' ) {
                $this->__delete_photo($category->image);
              }
              $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Category Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
              return redirect()->route('admin.category.view')->with('status', $status);
            }
            $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Sorry!! </strong>Something Went wrong.
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
        return view('admin.category.edit', compact('category'));
      }
    }
    return redirect()->route('admin.category.view');
  }


  /**
   * admin can delete category
   * @param Request $request
   * @return string
   */
  public function delete_category(Request $request){

      $id = $request->post('id');
      Category::where('id', $id)->update(['status' => "inactive"]);
      return 'success';
  }

  /**
   * admin can add sub category
   * @param Request $request
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function add_sub_category(Request $request){
    $categories = Category::where('status', '=', 'active')->select('id', 'name')->get();
    if($request->isMethod("POST")){
      $data = $request->all();

      $validator = Validator::make($data,[
        'category_id' => 'required|numeric',
        'name' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try {
        $sub_category = new SubCategory();
        $sub_category->category_id = $data['category_id'];
        $sub_category->name = $data['name'];
        if($sub_category->save()) {
          $sub_category->brands()->sync($data['brand_ids']);
          $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Sub Category added successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
          return redirect()->back()->with('status', $status);
        }
        $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Sorry!! </strong>Something Went wrong.
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
    $brands = Brand::select('id', 'name')->get();
    return view('admin.sub_category.add', compact('categories', 'brands'));
  }


  /**
   * admin can view all subcategory
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function view_sub_category(){
    $sub_categories = DB::table('sub_categories')
      ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
      ->where('sub_categories.status', '=', 'active')
      ->where('categories.status', '=', 'active')
      ->select('sub_categories.id', 'sub_categories.name', 'sub_categories.slug', 'categories.name as category')
      ->get();
    return view('admin.sub_category.view', compact('sub_categories'));
  }


  /**
   * amdin can edit subcategory
   * @param Request $request
   * @param null $slug
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function edit_sub_category(Request $request, $slug = null){
    if($slug != null){
      $categories = Category::where('status', '=', 'active')->get();
      $sub_category = SubCategory::where('slug', '=', $slug)->first();
      if(isset($sub_category)){
        if($request->isMethod("POST")){
          $data = $request->all();
          $validator = Validator::make($data,[
            'category_id' => 'required|numeric',
            'name' => 'required',
          ]);

          if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
          try {
            SubCategory::find($sub_category->id)->update(['slug'=>null]);
            $categoryUpdate = SubCategory::find($sub_category->id)->update([ 'category_id' => $data['category_id'], 'name' => $data['name']]);
            if($categoryUpdate) {
                $sub_category->brands()->sync($data['brand_ids']);
              $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Sub Category Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
              return redirect()->route('admin.sub-category.view')->with('status', $status);
            }
            $status = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Sorry!! </strong>Something Went wrong.
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
        $brandExists = $sub_category->brands->pluck('id');
        $brands  = Brand::select('id', 'name')->get();
        return view('admin.sub_category.edit', compact('categories', 'sub_category','brands', 'brandExists'));
      }
    }
    return redirect()->route('admin.sub-category.view');
  }

  /**
   * admin can delete sub category
   * @param Request $request
   * @return string
   */
  public function delete_sub_category(Request $request){
    if($request->isMethod('DELETE')){
      $id = $request->post('id');
      $sub_category = SubCategory::find($id);
      if($sub_category->delete()){
        $brand = Brand::where('sub_category_id', $id)->get();
        foreach ($brand as $item) {
          if(Brand::find($item->id)->delete()){
            $this->__delete_photo($item->image);
          }
        }
        return 'success';
      }
    }
  }


  /**
   * get sub-category from each category
   * @param Request $request
   * @return mixed
   */
  public function category_sub_category(Request $request) {
    if($request->isMethod('POST')){
      $category_id = $request->post('category_id');
      $subcategory = SubCategory::where('category_id', '=', $category_id)->where('status', '=', 'active')->select('id', 'category_id', 'name')->get();
      return $subcategory;
    }
  }


  /**
   * get brand from each category and subcategory
   * @param Request $request
   * @return mixed
   */
  public function sub_category_to_brand(Request $request) {
    if($request->isMethod('POST')){
      $brand_id = $request->post('brand_id');
      $brand = Brand::where('id', '=', $brand_id)->select('id', 'name')->get();
      return $brand;
    }
  }
}
