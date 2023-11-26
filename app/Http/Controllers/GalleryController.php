<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class GalleryController extends Controller
{
    //FrontEnd

    public function index()
    {
        $galleries = Gallery::join('users','galleries.author','users.id')
                    ->select('galleries.*','users.name AS author')
                    ->orderBy('galleries.created_at','DESC')
                    ->get();
        return view('site.gallery',compact('galleries'));
    }

    public function show($id)
    {
        $gallery = Gallery::join('users','galleries.author','users.id')
                ->where('galleries.id',$id)
                ->select('galleries.*','users.name AS author')
                ->orderBy('galleries.created_at','DESC')
                ->first();
                // return $gallery;
        return view('site.gallery_single',compact('gallery'));
    }


    //BackEnd

    public function view(){
        $posts = Gallery::join('users','galleries.author','users.id')
                ->select('galleries.*','users.name AS author')
                ->orderBy('galleries.created_at','DESC')
                ->get();
        return view('admin.gallery.view',compact('posts'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
        $data = $request->all();
        
        //   return $data;
        $validator = Validator::make($data, [
            'title' => 'required|string|max:250',
            'body' => 'required',
            'thumb_img' => 'required|mimes:jpeg,png,jpg,webp|max:800'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        //  return $data;

        if ($request->hasFile('thumb_img')) {
            $path2 = 'gallery_images/';
            $image2 = $request->file('thumb_img');
            $name2 = time().'.'.$image2->getClientOriginalExtension();
            $img = Image::make($image2->path());
            $thumb_img = $path2 . $name2;
            // $img->resize(600, 600)->save(public_path('/product_images/'.$name2));
            $img->save(public_path('/gallery_images/'.$name2));
        }
        
        try {
            $galleryPost = [
            'title' => $data['title'],
            'body' => $data['body'],
            'thumb_img' => $thumb_img,
            'author' => auth()->id(),
            ];

            if (Gallery::create($galleryPost)) {
            $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                        <strong>Congratulation!! </strong> Post has been added successful.
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
        return view('admin.gallery.add');
    }

    public function edit(Request $request, $id = null)
    {
        $post = Gallery::find($id);
        $old_image_path = public_path($post->thumb_img);
        // return $post;
        if ($request->isMethod('POST')) {
        $data = $request->all();
        
        //   return $data;
        $validator = Validator::make($data, [
            'title' => 'required|string|max:250',
            'body' => 'required',
            'thumb_img' => 'required|mimes:jpeg,png,jpg,webp|max:800'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        //  return $data;

        if ($request->hasFile('thumb_img')) {
            $path2 = 'gallery_images/';
            $image2 = $request->file('thumb_img');
            $name2 = time().'.'.$image2->getClientOriginalExtension();
            $img = Image::make($image2->path());
            $thumb_img = $path2 . $name2;
            // $img->resize(600, 600)->save(public_path('/product_images/'.$name2));
            $img->save(public_path('/gallery_images/'.$name2));
        }
        
        try {
            $galleryPost = [
            'title' => $data['title'],
            'body' => $data['body'],
            'thumb_img' => $thumb_img,
            'author' => auth()->id(),
            ];

            if (Gallery::where('id',$id)->update($galleryPost)) {
                if (file_exists($old_image_path)) {
                @unlink($old_image_path);
                }

            $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                        <strong>Congratulation!! </strong> Post has been updated successful.
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
        return view('admin.gallery.edit',compact('post'));
    }

    public function delete(Request $request) {
    if($request->isMethod('DELETE')){
        $id = $request->post('id');
        $post = Gallery::find($id);
        if($post->delete()){
            $old_image_path1 = public_path($post->thumb_img);
            if (file_exists($old_image_path1)) {
            @unlink($old_image_path1);
            }
            return 'success';
        }
        }
    }
}
