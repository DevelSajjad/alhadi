<?php

namespace App\Http\Controllers;

use App\Models\Socials;
use App\Notice;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialsController extends Controller
{
    public function add_socials(Request $request){
        if($request->isMethod("POST")){
            $data = $request->all();
//            $validator = Validator::make($data,[
//                'icon_code' => 'required|string|max:250',
//                'urls' => 'required|string',
//                'status' => 'required|string'
//            ]);
//
//            if ($validator->fails()) {
//
//                return redirect()->back()
//                    ->withErrors($validator)
//                    ->withInput();
//            }
            try {

                $socials = new Socials();
                $socials->icon_code = $data['icon_code'];
                $socials->url = $data['url'];
                $socials->status = $data['status'];

                if($socials->save()) {
                    $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Socials added successfully
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
        return view('admin.socials.add');
    }


    /**
     * @return mixed
     */
    public function view_socials(){
        $socials = Socials::select('id', 'icon_code', 'url', 'status', 'created_at')->get();
        return view('admin.socials.view', compact('socials'));
    }

    /**
     * @param Request $request
     * @param null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit_socials(Request $request, $id = null){
        if($id != null){
            $socials = Socials::find($id);
            if(isset($socials)){
                if($request->isMethod("POST")){
                    $data = $request->all();
                    $validator = Validator::make($data,[
                        'icon_code' => 'required|string|max:250',
                        'url' => 'required|string',
                        'status' => 'required|string',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    try {
//            return $socials;
                        $updateData = [
                            'icon_code' => $data['icon_code'],
                            'url' => $data['url'],
                            'status' => strtolower($data['status']),
                        ];

                        if($socials->update($updateData)) {

                            $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Notice Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
                            return redirect()->route('admin.socials.view')->with('status', $status);
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
                return view('admin.socials.edit', compact('socials'));
            }
        }
        return redirect()->route('admin.socials.view');
    }


    /**
     * admin can delete category
     * @param Request $request
     * @return string
     */
    public function delete_socials(Request $request){
        if($request->isMethod('DELETE')){
            $id = $request->post('id');
            $socials = Socials::find($id);
            if($socials->delete()){
                $this->__delete_photo($socials->file);
                return 'success';
            }
        }
    }




    public function socials(){
        $socialss = Notice::where('status', 'active')->select('id', 'title', 'description', 'file')->get();
        return view('site.socials', compact('socialss'));
    }
}
