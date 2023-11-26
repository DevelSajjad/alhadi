<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Product;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class BannerController extends Controller
{
  /**
   * admin can add Banner
   * @param Request $request
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function add_banner(Request $request){
    $products = Product::where('status', '=', 'active')->select('id', 'name')->get();
    if($request->isMethod("POST")){
      $data = $request->all();
      $validator = Validator::make($data,[
        'product_id' => 'required|numeric',
      ]);

      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
//      return $data;
      if ($request->hasFile('banner_image')) {
        $validator2 = Validator::make($request->all(), [
          'banner_image' => 'mimes:jpeg,png,jpg,webp|max:1024'
        ]);
        if ($validator2->fails()) {
          return redirect()->back()
            ->withErrors($validator2)
            ->withInput();
        }else{
          $image2 = $request->file('banner_image');
          $name2 = time() . '.' . $image2->getClientOriginalExtension();
          $path2 = 'banner_images/';
          $destinationPath2 = public_path($path2);
          $image2->move($destinationPath2, $name2);
        }
      }

      $banner_image = '';
      if (isset($name2)) {
        $banner_image = $path2 . $name2;
      }
//      return $banner_image;
      try {
        $banner = new Banner();
        $banner->product_id = $data['product_id'];
        $banner->image = $banner_image;
        if($banner->save()) {
          $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Banner added successfully
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
    return view('admin.banner.add', compact('products'));
  }


  /**
   * admin can view all subcategory
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function view_banner(){
    $banners = DB::table('banners')
      ->join('products', 'products.id', '=', 'banners.product_id')
      ->select('banners.id', 'banners.product_id', 'banners.image', 'banners.status', 'products.name', 'products.thumbnail_image as product_image')->get();
    return view('admin.banner.view', compact('banners'));
  }


  /**
   * amdin can edit subcategory
   * @param Request $request
   * @param null $slug
   * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function edit_banner(Request $request, $id = null){
    if($id != null){
      $products = Product::where('status', '=', 'active')->select('id', 'name')->get();
      $banner = Banner::where('id', '=', $id)->first();
      if(isset($banner)){
        if($request->isMethod("POST")){
          $data = $request->all();
          $validator = Validator::make($data,[
            'product_id' => 'required|numeric',
          ]);

          if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
//      return $data;
          if ($request->hasFile('banner_image')) {
            $validator2 = Validator::make($request->all(), [
              'banner_image' => 'mimes:jpeg,png,jpg,webp|max:1024'
            ]);
            if ($validator2->fails()) {
              return redirect()->back()
                ->withErrors($validator2)
                ->withInput();
            }else{
              $image2 = $request->file('banner_image');
              $name2 = time() . '.' . $image2->getClientOriginalExtension();
              $path2 = 'banner_images/';
              $destinationPath2 = public_path($path2);
              $image2->move($destinationPath2, $name2);
            }
          }

          $banner_image = '';
          if (isset($name2)) {
            $banner_image = $path2 . $name2;
          }
          $update_array = [
            'product_id' => $data['product_id']
          ];
          $remove_file = false;
          if($banner_image != ''){
            $remove_file = true;
            $update_array['image'] = $banner_image;
          }

//          return $update_array;
          try {
            $banner_update = Banner::find($banner->id)->update($update_array);
            if($banner_update) {
              if($remove_file){
                $old_image_path1 = public_path($banner->image);
                if (file_exists($old_image_path1)) {
                  @unlink($old_image_path1);
                }
              }
              $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Banner Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
              return redirect()->route('admin.banner.view')->with('status', $status);
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
        return view('admin.banner.edit', compact('banner', 'products'));
      }
    }
    return redirect()->route('admin.banner.view');
  }

  /**
   * admin can delete sub category
   * @param Request $request
   * @return string
   */
  public function delete_banner(Request $request){
    if($request->isMethod('DELETE')){
      $id = $request->post('id');
      $banner = Banner::find($id);
      if($banner->delete()){
        $old_image_path1 = public_path($banner->image);
        if (file_exists($old_image_path1)) {
          @unlink($old_image_path1);
        }
        return 'success';
      }
    }
  }


  public function change_banner_status(Request $request) {
    if($request->isMethod('POST')){
      $data = $request->all();
      $validator = Validator::make($data,[
        'id' => 'required|numeric',
        'status' => 'required',
      ]);

      if (!$validator->fails()) {
        $banner = Banner::find($data['id']);
        if($banner->update(['status'=>$data['status']])){
          return 'success';
        }
      }
    }
    return 'failed';
  }
}
