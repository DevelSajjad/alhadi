<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyInfoController extends Controller
{
    public function create(){
      $data = CompanyInfo::all()->first();
      if ($data != null){
        return to_route('admin.companyInfo.edit');
      }
      return view('admin.companyInfo.add');
    }

  public function store(Request $request){
    $request->validate([
      'company_name' => 'string',
      'address_one' => 'string',
      'address_two' => 'string',
      'email_one' => 'email',
      'email_two' => 'email',
      'phone_one' => 'min:8|max:11',
      'phone_two' => 'min:8|max:11',
      'trade_license' => 'max:240',
      'logo' => 'mimes:jpeg,jpg,png,webp',
    ]);

    try {
      if($request->hasFile('logo')){
        $path = 'companyInfo';
        $image = $request->logo->getClientOriginalName();
        $request->logo->move(public_path($path), $image);
        $logo = 'companyInfo/'.$image;
      }

      CompanyInfo::create([
        'company_name' => $request->company_name,
        'address_one' => $request->address_one,
        'address_two' => $request->address_two,
        'email_one' => $request->email_one,
        'email_two' => $request->email_two,
        'phone_one' => $request->phone_one,
        'phone_two' => $request->phone_two,
        'trade_license' => $request->trade_license,
        'logo' => isset($logo) ? $logo : 'dummy.jpg',
      ]);
      return to_route('admin.companyInfo.edit')->with('message','Company Info successfully added');


    }catch (\Throwable $th){
      throw $th;
    }
  }

    public function edit(){
        $data = CompanyInfo::all()->first();
      if ($data == null){
        return to_route('admin.companyInfo.create');
      }
        return view('admin.companyInfo.edit', compact('data'));
    }

  public function update(Request $request){
    $request->validate([
      'company_name' => 'string',
      'address_one' => 'string',
      'address_two' => 'string',
      'email_one' => 'email',
      'email_two' => 'email',
      'phone_one' => 'min:8|max:11',
      'phone_two' => 'min:8|max:11',
      'trade_license' => 'max:240',
      'logo' => 'mimes:jpeg,jpg,png,webp',
    ]);

    try {
      $data = CompanyInfo::findOrFail($request->id);
      if($request->hasFile('logo')){
        $image_path = public_path($data->logo);

        if(file_exists($image_path)){
          File::delete( $image_path);
        }
        $path = 'companyInfo';
        $image = $request->logo->getClientOriginalName();
        $request->logo->move(public_path($path), $image);
        $logo = 'companyInfo/'.$image;
      }else{
        $logo = $data->logo;
      }

      $data->update([
        'company_name' => $request->company_name,
        'address_one' => $request->address_one,
        'address_two' => $request->address_two,
        'email_one' => $request->email_one,
        'email_two' => $request->email_two,
        'phone_one' => $request->phone_one,
        'phone_two' => $request->phone_two,
        'trade_license' => $request->trade_license,
        'logo' => isset($logo) ? $logo : 'dummy.jpg',
      ]);
      return to_route('admin.companyInfo.edit')->with('message','Company Info successfully updated');


    }catch (\Throwable $th){
      throw $th;
    }
  }
}
