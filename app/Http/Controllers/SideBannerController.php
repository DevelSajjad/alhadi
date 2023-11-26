<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use App\SideBanner;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use phpDocumentor\Reflection\Types\Null_;

class SideBannerController extends Controller
{
    public function add(Request $request)
    {
        $products = Product::orderBy('name', 'ASC')->get();
        if ($request->isMethod('POST')) {
            $data = $request->all();

            //   return $data;
            $validator = Validator::make($data, [
                'title' => 'required|string|max:250',
                'banner_img' => 'required|mimes:jpeg,png,jpg,webp|max:800',
                'product_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //  return $data;

            if ($request->hasFile('banner_img')) {
                $path2 = 'side_banner_images/';
                $destinationPath2 = public_path($path2);
                if(!File::isDirectory($destinationPath2)){
                    File::makeDirectory($destinationPath2, 0777, true, true);
                }
                $image2 = $request->file('banner_img');
                $name2 = time() . '.' . $image2->getClientOriginalExtension();
                $img = Image::make($image2->path());
                $banner_img = $path2 . $name2;
                // $img->resize(100, 100)->save(public_path('/side_banner_images/' . $name2));
                $img->save(public_path('/side_banner_images/' . $name2));
            }

            try {
                $sidebannerInfo = [
                    'title' => $data['title'],
                    'banner_img' => $banner_img,
                    'product_id' => $data['product_id'],
                    'status' => $data['status']
                ];

                if (SideBanner::create($sidebannerInfo)) {
                    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                        <strong>Congratulation!! </strong> New Side Banner successfully added!!.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    return redirect()->back()->with('status', $status);
                }

                $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                        <strong>Sorry!! </strong>Something went wrong.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                return redirect()->back()->with('status', $status)->withInput();
            } catch (QueryException $e) {
                //        dd($e);
                $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                        <strong>Sorry!!! </strong>Something Went wrong.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                return redirect()->back()->with('status', $status)->withInput();
            }
        }

        return view('admin.sidebanner.add', compact('products'));
    }


    public function edit(Request $request, $id = Null)
    {
        $products = Product::orderBy('name', 'ASC')->get();
        $side_banner = SideBanner::find($id);
        $old_image_path = public_path($side_banner->banner_img);
        $banner_img = '';

        // return $post;
        if ($request->isMethod('POST')) {
            $data = $request->all();

            // return $data;
            $validator = Validator::make($data, [
                'title' => 'required|string|max:250',
                'banner_img' => 'mimes:jpeg,png,jpg,webp|max:800',
                'product_id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //  return $data;

            if ($request->hasFile('banner_img')) {
                $path2 = 'side_banner_images/';
                $image2 = $request->file('banner_img');
                $name2 = time() . '.' . $image2->getClientOriginalExtension();
                $img = Image::make($image2->path());
                $banner_img = $path2 . $name2;
                // $img->resize(100, 100)->save(public_path('/side_banner_images/' . $name2));
                $img->save(public_path('/side_banner_images/' . $name2));
                if (file_exists($old_image_path)) {
                    @unlink($old_image_path);
                }
            }else{
                $banner_img = $data['banner'];
            }

            try {
                $sidebannerInfo = [
                    'title' => $data['title'],
                    'banner_img' => $banner_img,
                    'product_id' => $data['product_id'],
                    'status' => $data['status']
                ];

                if (SideBanner::where('id', $id)->update($sidebannerInfo)) {

                    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                        <strong>Congratulation!! </strong> Side Banner updated successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    return redirect()->back()->with('status', $status);
                }

                $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                        <strong>Sorry!! </strong>Something went wrong.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                return redirect()->back()->with('status', $status)->withInput();
            } catch (QueryException $e) {
                //        dd($e);
                $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                        <strong>Sorry!!! </strong>Something Went wrong.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                return redirect()->back()->with('status', $status)->withInput();
            }
        }
        return view('admin.sidebanner.edit', compact('products','side_banner'));
    }


    public function view()
    {
        $side_banners = SideBanner::join('products', 'products.id', 'side_banners.product_id')
            ->select('side_banners.*', 'products.name as product_name')
            // ->where('side_banners.status','active')
            ->orderBy('side_banners.id', 'DESC')
            ->get();

        // return $side_banners;
        return view('admin.sidebanner.view', compact('side_banners'));
    }

    public function delete(Request $request)
    {
        if ($request->isMethod('DELETE')) {
            $id = $request->post('id');
            $side_banner = SideBanner::find($id);
            if ($side_banner->delete()) {
                $old_image_path1 = public_path($side_banner->banner_img);
                if (file_exists($old_image_path1)) {
                    @unlink($old_image_path1);
                }
                return 'success';
            }
        }
    }
}
