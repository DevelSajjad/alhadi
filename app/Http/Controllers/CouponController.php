<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function add(Request $request){
        if ($request->isMethod('POST')) {
            $data = $request->all();
        
        //   return $data;
            $validator = Validator::make($data, [
                'title' => 'string|max:250',
                'code' => 'required',
                'discount_amount' => 'required',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            try {
                $coupon = [
                'title' => $data['title'],
                'code' => $data['code'],
                'discount_amount' =>$data['discount_amount']
                ];
                if (Coupon::create($coupon)) {
                $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                            <strong>Congratulation!! </strong> Coupon has been added successful.
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
                $status = '<div class="alert alert-warning alert-dismissible show" role="alert">
                            <strong>Sorry!!! </strong>Something Went wrong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                return redirect()->back()->with('status', $status)->withInput();
            }
        }
        $coupons = Coupon::all();
        return view('admin.coupon.add',compact('coupons'));
    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);

        try{
            if ($coupon->delete()) {
                $status2 = '<div class="alert alert-success alert-dismissible show" role="alert">
                            <strong>Congratulation!! </strong> Coupon has been Deleted.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                return redirect()->back()->with('status2', $status2);
                }
    
                $status2 = '<div class="alert alert-warning alert-dismissible show" role="alert">
                            <strong>Sorry!! </strong>Something went wrong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                return redirect()->back()->with('status2', $status2);
            }catch(QueryException $exc){
                $status2 = '<div class="alert alert-warning alert-dismissible show" role="alert">
                            <strong>Sorry!!! </strong>Something Went wrong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                return redirect()->back()->with('status2', $status2);
            }
        
    }

    public function isvalidCoupon($coupon)
    {
        $coupon = Coupon::where('code','=',$coupon)->first();
        if($coupon!=null){
            $amount = $coupon->discount_amount; 
            return $amount;
        }else
        return 0;
        
    }
}
