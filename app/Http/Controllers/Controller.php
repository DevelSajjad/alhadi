<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Message;
use App\Models\CompanyInfo;
use App\Notice;
use App\Order;
use App\SubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Http;
use View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __saveMsg($no, $body, $uid=null, $status = 'pending')
    {
        try {
            $mes = new \App\Message();
            if($uid!=null){
                $mes->u_id = $uid;
            }
            $mes->number = $no;
            $mes->body = $body;
            $mes->status = $status;
            $mes->save();
            return $mes;
        } catch (\Exception $e) {
        }
        return 'sorry';
    }

//  public function __sendMessage($phone, $message)
//  {
//    $username = "finlitebd";
//    $hash = "5eb2b9127467d9d9b5f9b2b85286bfb5";
//    $params = array('app' => 'ws', 'u' => $username, 'h' => $hash, 'op' => 'pv', 'unicode' => '1', 'to' => $phone, 'msg' => $message);
//
//
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://alphasms.biz/index.php?" . http_build_query($params, "", "&"));
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "Accept:application/json"));
//    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//
//    $response = \GuzzleHttp\json_decode(curl_exec($ch));
//    curl_close($ch);
//
//    if (isset($response->data)) {
//      $res = $response->data[0]->status;
//      if ($res == "OK") {
//        $this->__saveMsg($phone, $message, 'success');
//        return true;
//      }
//    }
//    $this->__saveMsg($phone, $message);
//    return false;
//  }

    public function __sendMessage($phone, $message)
    {
        if (env('APP_ENV', 'local') == 'local'){
            return true;
        }
        try {
            $res = Http::withoutVerifying()->get('http://smpp.ajuratech.com:7788/sendtext',[
                'apikey' => '6f1e6879768dcb7a',
                'secretkey' => '9030e0e7',
                'callerID' => '8809612448803',
                'toUser' => $phone,
                'messageContent' => $message,
            ]);
            $this->__saveMsg($phone, $message, $res['Message_ID'],'success');
            return true;
        } catch (\Exception $e) {
//      return $e;
        }
        $this->__saveMsg($phone, $message);
        return false;
    }


    public function __delete_photo($image = null)
    {
        if ($image !== null) {
            $old_image_path = public_path($image);
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }
        }
    }


    #find array keys
    public function findKey($array, $keySearch)
    {
        foreach ($array as $key => $item) {
            if ($key == $keySearch) {
                return true;
            } elseif (is_array($item) && $this->findKey($item, $keySearch)) {
                return true;
            }
        }
        return false;
    }

    /*
     * category with subcategory
     * */
    public function category_with_subcategory()
    {

        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();

        $cat_subCat = [];
        foreach ($categories as $category) {
            $cat_subCat [$category->id] = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'image' => $category->image,
                'sub_category' => []
            ];
        }

//    return $subCategories;
        foreach ($subCategories as $subCategory) {
            if (!$this->findKey($cat_subCat, $subCategory->category_id)) {
                $cat_subCat[$subCategory->category_id]['sub_category'][$subCategory->id] = [
                    'id' => $subCategory->id,
                    'name' => $subCategory->name,
                    'slug' => $subCategory->slug,
                    'brand' => []
                ];
            } else {
                $cat_subCat[$subCategory->category_id]['sub_category'] [$subCategory->id] = [
                    'id' => $subCategory->id,
                    'name' => $subCategory->name,
                    'slug' => $subCategory->slug,
                    'brand' => []
                ];
            }
        }

        foreach ($brands as $brand) {
            if ($this->findKey($cat_subCat, $brand->category_id)) {
                if (!$this->findKey($cat_subCat[$brand->category_id]['sub_category'], $brand->sub_category_id)) {
                    $cat_subCat[$brand->category_id]['sub_category'][$brand->sub_category_id]['brand'][] = [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'image' => $brand->image,
                        'slug' => $brand->slug,
                    ];
                } else {
                    $cat_subCat[$brand->category_id]['sub_category'][$brand->sub_category_id]['brand'][] = [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'image' => $brand->image,
                        'slug' => $brand->slug,
                    ];
                }
            } else {
            }
        }
        return $cat_subCat;
    }

    public function get_category()
    {
        $category = Category::where('status', '=', 'active')->get();
        return $category;
    }

    public function get_brands()
    {
        $brands = Brand::select('name', 'id', 'image')->get();
        return $brands;
    }


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()) {
                if (strtolower(Auth::user()->type) == 'admin' || strtolower(Auth::user()->type) == 'moderator') {
                    $logout_time = Auth::user()->log_out_at;
                    if (isset($logout_time)) {
                        $orderNotify = Order::where('created_at', '>=', $logout_time)->select('id', 'amount', 'area', 'status', 'created_at')->get();
                    } else {
                        $orderNotify = Order::select('id', 'amount', 'area', 'status', 'created_at')->get();
                    }
                    View::share('orderNotify', $orderNotify);
                }

                $last_order = Order::where('customer_id', \auth()->id())->latest('created_at')->select('id', 'status', 'created_at')->first();

                View::share('last_order', $last_order);

            }
//      $cat_subCat = $this->category_with_subcategory();

            $notice = Notice::where('status', 'active')->first();
            if (isset($notice)) {
                View::share('home_notice', $notice);
            }


            View::share('home_category', Category::where('status', 'active')->with('subcategories.brands:id,name,slug')->get());
            View::share('company_info', CompanyInfo::all()->first());
            View::share('home_brands', $this->get_brands());

            $compare_data = \Session::get('compare');
            if (!isset($compare_data)) {
                $compare_data = [];
            }
            View::share('compare_count', count($compare_data));

            return $next($request);
        });
    }

}
