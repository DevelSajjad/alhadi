<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
  public function add_notice(Request $request){
    if($request->isMethod("POST")){
      $data = $request->all();
      $validator = Validator::make($data,[
        'title' => 'required|string|max:250',
        'description' => 'required|string',
        'notice_file' => 'nullable|mimes:jpeg,png,jpg,webp,pdf|max:1000'
      ]);

      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try {

        if ($request->hasFile('notice_file')) {
          $image = $request->file('notice_file');
          $name = time() . '.' . $image->getClientOriginalExtension();
          $path = 'notice_file/';
          $destinationPath = public_path($path);
          $image->move($destinationPath, $name);
        }

        $notice_file = '';
        if (isset($name)) {
          $notice_file = $path . $name;
        }


        $notice = new Notice();
        $notice->title = $data['title'];
        $notice->description = $data['description'];
        if($notice_file != '') {
          $notice->file = $notice_file;
        }
        if($notice->save()) {
          $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Notice added successfully
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
    return view('admin.notice.add');
  }


  /**
   * @return mixed
   */
  public function view_notice(){
    $notices = Notice::select('id', 'title', 'description', 'status', 'created_at')->get();
    return view('admin.notice.view', compact('notices'));
  }

  /**
   * @param Request $request
   * @param null $slug
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
   */
  public function edit_notice(Request $request, $id = null){
    if($id != null){
      $notice = Notice::find($id);
      if(isset($notice)){
        if($request->isMethod("POST")){
          $data = $request->all();
          $validator = Validator::make($data,[
            'title' => 'required|string|max:250',
            'description' => 'required|string',
            'notice_file' => 'nullable|mimes:jpeg,png,jpg,webp,pdf|max:1000',
            'status' => 'required|string',
          ]);

          if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
          try {
//            return $notice;
            if ($request->hasFile('notice_file')) {
              $image = $request->file('notice_file');
              $name = time() . '.' . $image->getClientOriginalExtension();
              $path = 'notice_file/';
              $destinationPath = public_path($path);
              $image->move($destinationPath, $name);
            }
            $notice_file = '';
            if (isset($name)) {
              $notice_file = $path . $name;
            }
            $updateData = [
              'title' => $data['title'],
              'description' => $data['description'],
              'status' => strtolower($data['status']),
            ];

            if($notice_file != ''){
              $updateData['file'] = $notice_file;
            }
            $old_file = $notice->file;
            if($notice->update($updateData)) {
              if($notice_file !='' ) {
                $this->__delete_photo($old_file);
              }
              $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Notice Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
              return redirect()->route('admin.notice.view')->with('status', $status);
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
        return view('admin.notice.edit', compact('notice'));
      }
    }
    return redirect()->route('admin.notice.view');
  }


  /**
   * admin can delete category
   * @param Request $request
   * @return string
   */
  public function delete_notice(Request $request){
    if($request->isMethod('DELETE')){
      $id = $request->post('id');
      $notice = Notice::find($id);
      if($notice->delete()){
        $this->__delete_photo($notice->file);
        return 'success';
      }
    }
  }




  public function notice(){
    $notices = Notice::where('status', 'active')->select('id', 'title', 'description', 'file')->get();
    return view('site.notice', compact('notices'));
  }
}
