<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    public function create(){
      $policy = Policy::where('type','policy')->first();
      if ($policy != null){
        return to_route('admin.policy.view');
      }
      return view('admin.refundPolicy.add');
    }

    public function view(){
      $policy = Policy::where('type','policy')->first();
      if ($policy == null){
        return to_route('admin.policy.create');
      }
      return view('admin.refundPolicy.view', compact('policy') );
    }

    public function viewBN(){
      $policy = Policy::where('type','policy')->first();
      if ($policy == null){
        return to_route('admin.policy.create');
      }
      return view('admin.refundPolicy.viewBN', compact('policy') );
    }

    public function update(){
      $policy = Policy::where('type','policy')->first();
      if ($policy == null){
        return to_route('admin.policy.create');
      }
      return view('admin.refundPolicy.edit', compact('policy'));
    }

    public function store(Request $request){
      $message = 'Congratulations!!! Return policy successfully ';
      if ($request->has('id')) {
        $returnPolicy = Policy::find($request->id);
        $message = $message . ' updated';
      } else {
        $returnPolicy = new Policy();
        $message = $message . ' created';
      }
      $rules['title_en'] = 'required|string';
      $rules['title_bn'] = 'required|string';
      $rules['description_en'] = 'required|string';
      $rules['description_bn'] = 'required|string';
      $request->validate($rules);

      try {
        $returnPolicy->title_en = $request->title_en;
        $returnPolicy->title_bn = $request->title_bn;
        $returnPolicy->description_en = $request->description_en;
        $returnPolicy->description_bn = $request->description_bn;
        $returnPolicy->type = 'policy';
        if ($returnPolicy->save()) {
          return to_route('admin.policy.view')->with('message', $message);
        }
        $message = 'Sorry!!! Operation Failed!! ';
        return to_route('admin.policy.view')->with('status', $message);
      } catch (\Throwable $th){
        throw $th;
      }

    }

}
