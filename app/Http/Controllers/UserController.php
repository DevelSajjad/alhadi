<?php

namespace App\Http\Controllers;

use App\Otp;
use App\Rules\Captcha;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;

class UserController extends Controller
{

  public function __createOTP($user, $type, $message){
    $randomNum = substr(str_shuffle("0123456789"), 0,6);
    $Otp = Otp::updateOrCreate([
      'user_id' => $user->id,
      'type' => $type,
    ], [
      'otp' => $randomNum
    ]);

    //          send message to user phone no
    try {
      $this->__sendMessage($user->mobile_no, $message.$Otp->otp.". From AL Hadi Enterprise");
    }catch (\ErrorException $ex){

    }
  }


  public function admin_login(Request $request){
    if(Auth::user() == null) {
      if ($request->isMethod('post')) {
        $validator = Validator::make($request->all(), [
          'email' => 'required',
          'password' => 'required|min:6',
        //   'g-recaptcha-response' => new Captcha()
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $data = $request->all();



        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 'active'])) {
          if(\auth()->user()->type == 'admin' || \auth()->user()->type == 'moderator') {
            return redirect()->route('admin.dashboard');
          }
          Auth::logout();
        }
        $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
          Invalid User.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>';
        return redirect()->back()->with('status', $status)->withInput();

      }
      return view('admin.login');
    }
    return redirect()->route('admin.dashboard');

  }


  public function customer_logout(){
    Auth::logout();
    $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
      Logout successful.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>';
    return redirect()->route('login')->with('status', $status);
  }


  public function login(Request $request){
    if(\auth()->user()){
      return redirect()->route('home');
    }

    if($request->isMethod("POST")){
      $data = $request->all();
      $validator = Validator::make($data, [
        'mobile_no' => 'required|min:11',
        'password' => 'required|min:6',
//            'g-recaptcha-response' => new Captcha()
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      if (Auth::attempt(['mobile_no' => $data['mobile_no'], 'password' => $data['password']])) {
        $user = User::find(\auth()->id());
        if($user->type == 'customer'){
          if($user->status == 'inactive'){
            $otp = Otp::where('user_id', $user->id)->latest()->first();
            Auth::logout();
            if(isset($otp) && $otp->type == 'forgotPassword'){
              \Session::put('fp_mobile_no', $user->mobile_no);
              return redirect()->route('verify.forgotPasswordOTP');
            }

            $this->__createOTP($user, 'registration', 'OTP for registration is ');

            \Session::put('reg_mobile_no', $user->mobile_no);
            $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
              Verification otp is sent to your mobile.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            return redirect()->route('verify.regOTP')->with('status', $status);
          }
          $redirectToCheckout = \Session::get('checkout');
          if(isset($redirectToCheckout) && $redirectToCheckout == '1'){
            \Session::forget('checkout');
            return redirect()->route('customer.checkout');
          }
          return redirect()->route('customer.dashboard');
        }
        Auth::logout();
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
          <strong>Sorry!!!</strong> You are not a customer.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        return redirect()->back()->with('status', $status);
      }
      $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
          Invalid user or password.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      return redirect()->back()->with('status', $status)->withInput();
    }
    return view('site.login');
  }


  public function registration(Request $request){
    if(\auth()->user()){
      return redirect()->route('home');
    }
    if($request->isMethod("POST")){
      $data = $request->all();
      $validator = Validator::make($data, [
        'mobile_no' => 'required|numeric|min:11|unique:users',
        'email' => 'email|unique:users',
        'password' => 'required|min:6',
        'confirm_password' => 'required|min:6|same:password'
//            'g-recaptcha-response' => new Captcha()
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }

      $user = new User();
      $user->name = $data['name'];
      $user->mobile_no = $data['mobile_no'];
      if(isset($data['email'])) {
        $user->email = $data['email'];
      }
      $user->password = Hash::make($data['password']);
      $user->status = 'active';
      if($user->save()){

//        $this->__createOTP($user, 'registration', 'OTP for registration is ');

//        \Session::put('reg_mobile_no', $user->mobile_no);
//        $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
//          <strong>Congratulation!!!</strong> Verification otp is sent to your mobile.
//          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//            <span aria-hidden="true">&times;</span>
//          </button>
//        </div>';
//        return redirect()->route('verify.regOTP')->with('status', $status);

        $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
          <strong>Congratulation!!!</strong> Registration Successful.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        return redirect()->route('login')->with('status', $status);
      }
      $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
        Something went wrong.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      return redirect()->back()->with('status', $status)->withInput();
    }
    return view('site.register');
  }


  public function reg_verify_otp(Request $request){
    $phone = \Session::get('reg_mobile_no');
    if(isset($phone)) {
      if ($request->isMethod("POST")) {
        $data = $request->all();
        $validator = Validator::make($data, [
          'otp' => 'required|min:6|numeric',
//            'g-recaptcha-response' => new Captcha()
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = User::where('mobile_no', '=', $phone)->first();
        if(isset($user)) {
          $otp = Otp::where('user_id', $user->id)->where('type', 'registration')->where('otp', $data['otp'])->first();
          if(isset($otp)){
            Otp::where('user_id', $user->id)->delete();
            \Session::forget('reg_mobile_no');
            $login_user = User::find($user->id);
            $login_user->update(['status'=>'active']);
            Auth::login($login_user);
            return redirect()->route('home');
          }
          $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
                      Invalid Otp.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
          return redirect()->back()->with('status', $status)->withInput();
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
                      Something went wrong.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
        return redirect()->back()->with('status', $status)->withInput();
      }
      return view('site.reg_verify_otp');
    }
    return redirect()->route('home');
  }


  public function forgot_password(Request $request) {
    if(\auth()->user()){
      return redirect()->route('home');
    }
    if($request->isMethod("POST")){
      $data = $request->all();
      $validator = Validator::make($data, [
        'mobile_no' => 'required|min:11',
//            'g-recaptcha-response' => new Captcha()
      ]);
//      return $data;
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      $user = User::where('mobile_no', $data['mobile_no'])->first();
//      return $user;
      if(isset($user)){
        if($user->type == 'customer'){
          $randomNum = substr(str_shuffle("0123456789"), 0,6);
          $Otp = Otp::updateOrCreate([
            'user_id' => $user->id,
            'type' => 'forgotPassword',
          ], [
            'otp' => $randomNum
          ]);
          User::find($user->id)->update(['status'=>'inactive']);
          try {
            $this->__sendMessage($user->mobile_no, "OTP to reset password is ".$Otp->otp.". From AL Hadi Enterprise");
          }catch (Exception $ex){

          }
          \Session::put('fp_mobile_no', $user->mobile_no);
          $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulation!!!</strong> Verification otp is sent to your mobile.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          return redirect()->route('verify.forgotPasswordOTP')->with('status', $status);
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
          <strong>Sorry!!!</strong> You cann\'t try it.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        return redirect()->back()->with('status', $status)->withInput();
      }
      $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
          Invalid mobile no.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      return redirect()->back()->with('status', $status)->withInput();
    }
    return view('site.forgot_password');
  }


  public function forgot_password_verify_otp(Request $request){
    $phone = \Session::get('fp_mobile_no');
    if(isset($phone)) {
      if ($request->isMethod("POST")) {
        $data = $request->all();
        $validator = Validator::make($data, [
          'otp' => 'required|min:6|numeric',
//            'g-recaptcha-response' => new Captcha()
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = User::where('mobile_no', '=', $phone)->first();
        if(isset($user)) {
          $otp = Otp::where('user_id', $user->id)->where('type', 'forgotPassword')->where('otp', $data['otp'])->first();
          if(isset($otp)){
            Otp::where('user_id', $user->id)->delete();
            \Session::forget('fp_mobile_no');
            \Session::put('fp_user_id', $user->id);
            return redirect()->route('resetPassword');
          }
          $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
                      Invalid Otp.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
          return redirect()->back()->with('status', $status)->withInput();
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
                      Something went wrong.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>';
        return redirect()->back()->with('status', $status)->withInput();
      }
      return view('site.forgot_pass_verify_otp');
    }
    return redirect()->route('home');
  }


  public function reset_password(Request $request){
    $id = \Session::get('fp_user_id');
    if(isset($id)){
      if($request->isMethod('POST')){
        $data=$request->all();
        $validator = Validator::make($data, [
          'password' => 'required|min:6',
          'confirm_password' => 'required|min:6|same:password',
//            'g-recaptcha-response' => new Captcha()
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = User::find($id);
        if(isset($user)){
          if($user->update(['password'=>Hash::make($data['password']), 'status'=>'active'])){
            \Session::forget('fp_user_id');
            $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
              <strong>Congratulation!!!</strong> Password reset successful.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
            return redirect()->route('login')->with('status', $status);
          }
        }
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
          <strong>Sorry!!!</strong> Something went wrong.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        return redirect()->back()->with('status', $status)->withInput();
      }
      return view('site.reset_password');
    }
    return redirect()->route('home');
  }


  public function customer_profile() {
    return view('site.customer.profile');
  }


  public function customer_change_password(Request $request) {
      try{
      if($request->isMethod('POST')){
        $data = $request->all();
//        return $data;
        $validator = Validator::make($data, [
          'old_password' => 'required|min:6',
          'new_password' => 'required|min:6',
          'confirm_password' => 'required|min:6|same:new_password',
  //            'g-recaptcha-response' => new Captcha()
        ]);
        if ($validator->fails()) {
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = Auth::user();
//        return $user;
        if(Auth::guard('web')->attempt(['id'=>$user->id,'password'=>$data['old_password']])){
          $user->password = Hash::make($data['new_password']);
          $user->save();
          $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulation!!!</strong> Password successfully changed.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          return redirect()->route('customer.profile')->with('status', $status);
        }else{
          $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
            <strong>Sorry!!!</strong> Something went wrong.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          return redirect()->back()->with('status', $status)->withInput();
        }
      }
    }catch (QueryException $e){
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
          Something went wrong.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        return redirect()->back()->with('status', $status)->withInput();
    }
    return view('site.customer.change_password');
  }


  public function customer_update_profile(Request $request){
    if($request->isMethod('POST')){
      $user = User::find(\auth()->id());
      $data = $request->all();
//        return $data;
      $validator = Validator::make($data, [
        'name' => 'required',
        'mobile_no' => 'required|min:11|numeric|unique:users,mobile_no,'. $user->id,
        'email' => 'nullable|email|unique:users,email,'. $user->id,
        'image' => 'nullable|mimes:jpeg,bmp,png,jpg,webp|max:100'
      ]);
      if ($validator->fails()) {
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $path = 'users_images/';
        $destinationPath = public_path($path);
        $image->move($destinationPath, $name);
      }
      $user_image = '';
      if(isset($name)){
        $user_image = $path.$name;
      }
      $data = array_filter($data);
      if($user_image != ''){
        $data['image'] = $user_image;
      }
      $old_image = $user->image;
      if($user->update($data)){
        if($user_image != ''){
          $old_image_path1 = public_path($old_image);
          if (file_exists($old_image_path1)) {
            @unlink($old_image_path1);
          }
        }
        $status = '<div class="alert alert-success alert-dismissible  show" role="alert">
            <strong>Congratulation!!!</strong> Profile successfully updated.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        return redirect()->route('customer.profile')->with('status', $status);
      }else{
        $status = '<div class="alert alert-warning alert-dismissible  show" role="alert">
            <strong>Sorry!!!</strong> Something went wrong.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        return redirect()->back()->with('status', $status)->withInput();
      }

    }
    return view('site.customer.update_profile');
  }


}
