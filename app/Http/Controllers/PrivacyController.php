<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivacyController extends Controller
{
    public function create(){
      $privacy = Privacy::where('type','privacy')->first();
      if ($privacy != null){
        return to_route('admin.privacy.view');
      }
      return view('admin.privacyPolicy.add');
    }

    public function view(){
      $privacy = Privacy::where('type','privacy')->first();
      if ($privacy == null){
        return to_route('admin.privacy.create');
      }
      return view('admin.privacyPolicy.view', compact('privacy') );
    }

    public function viewBN(){
      $policy = Privacy::where('type','privacy')->first();
      if ($policy == null){
        return to_route('admin.privacy.create');
      }
      return view('admin.privacyPolicy.viewBN', compact('policy') );
    }

    public function update(){
      $privacy = Privacy::where('type','privacy')->first();
      if ($privacy == null){
        return to_route('admin.privacy.create');
      }
      return view('admin.privacyPolicy.edit', compact('privacy'));
    }

    public function store(Request $request){
      $message = 'Congratulations!!! Privacy policy successfully ';
      if ($request->has('id')) {
        $privacy = Privacy::find($request->id);
        $message = $message . ' updated';
      } else {
        $privacy = new Privacy();
        $message = $message . ' created';
      }
      $rules['title_en'] = 'required|string';
        $rules['overview'] = 'required|string';
      //   $rules['title_bn'] = 'required|string';
      $rules['description'] = 'required|string';
    //   $rules['description_bn'] = 'required|string';
      $request->validate($rules);

      try {
        $privacy->title_en = $request->title_en;
        $privacy->overview = $request->overview;
        // $privacy->title_bn = $request->title_bn;
        $privacy->description = $request->description;
        // $privacy->description_bn = $request->description_bn;
        $privacy->type = 'privacy';
        if ($privacy->save()) {
          return to_route('admin.privacy.view')->with('message', $message);
        }
        $message = 'Sorry!!! Operation Failed!! ';
        return to_route('admin.privacy.view')->with('status', $message);
      } catch (\Throwable $th){
        throw $th;
      }

    }

}
