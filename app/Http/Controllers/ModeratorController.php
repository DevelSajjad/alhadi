<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class ModeratorController extends Controller
{
    public function add_moderator(Request $request){

      if($request->isMethod('POST')){
        $data = $request->all();
        $validator = Validator::make($data, [
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'mobile_no' => 'required|numeric|min:11|unique:users',
          'password' => 'required|min:6',
          'image' => 'nullable|mimes:jpeg,bmp,png,jpg,webp|max:100'
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try{
          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $path = 'users_images/';
            $destinationPath = public_path($path);
            $image->move($destinationPath, $name);
          }
          $user_iamge = '';
          if (isset($name)) {
            $user_iamge = $path . $name;
          }
          $user = new User();
          $user->name = $data['name'];
          $user->email = $data['email'];
          $user->mobile_no= $data['mobile_no'];
          $user->password = Hash::make($data['password']);
          $user->type = 'moderator';
          $user->status = 'active';
          if($user_iamge != ''){
            $user->image = $user_iamge;
          }
          if($user->save()){

            $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulation!!!</strong> Moderator successfully added.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            return redirect()->route('admin.moderator.view')->with('status', $status);
          }else{
            $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
            <strong>Sorry!!!</strong> Something went wrong.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
            return redirect()->back()->with('status', $status)->withInput();
          }

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
        return view('admin.moderator.add');
    }

    public function view_moderator(){
      $moderators = User::where('type', 'moderator')->select('id', 'image', 'name', 'email', 'mobile_no', 'status')->get();
//      return $moderators;
      return view('admin.moderator.view', compact('moderators'));
    }

    public function edit_moderator(Request $request, $id = null){
      $moderator = User::where('id', $id)->where('type', 'moderator')->first();
      if(isset($moderator)){
        if($request->isMethod("POST")){
          $data = $request->all();
          $validator = Validator::make($data, [
            'status' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $moderator->id,
            'mobile_no' => 'required|numeric|min:11|unique:users,mobile_no,'. $moderator->id,
            'password' => 'nullable|min:6',
            'image' => 'nullable|mimes:jpeg,bmp,png,jpg,webp|max:100'
          ]);
          if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
          try{
            if ($request->hasFile('image')) {
              $image = $request->file('image');
              $name = time() . '.' . $image->getClientOriginalExtension();
              $path = 'users_images/';
              $destinationPath = public_path($path);
              $image->move($destinationPath, $name);
            }
            $user_iamge = '';
            if (isset($name)) {
              $user_iamge = $path . $name;
            }
            $updateData = [
              'status' => $data['status'],
              'name' => $data['name'],
              'email' => $data['email'],
              'mobile_no' => $data['mobile_no']
            ];

            if($user_iamge != ''){
              $updateData['image'] = $user_iamge;
            }
            if(isset($data['password']) && $data['password'] !== null && $data['password'] !== "" ){
              $updateData['password'] = Hash::make($data['password']);
            }
            $userUpdate = User::find($moderator->id)->update($updateData);
            if($userUpdate) {
              if($user_iamge !='' ) {
                $this->__delete_photo($moderator->image);
              }
              $status = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulation!!!</strong> Moderator Updated successfully
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
              return redirect()->route('admin.moderator.view')->with('status', $status);
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
        return view('admin.moderator.edit', compact('moderator'));
      }
      return redirect()->route('admin.moderator.view');
    }


    public function delete_moderator(Request $request){

    }
}
