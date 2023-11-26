<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //   return $data;
            $validator = Validator::make($data, [
                'mobile_no' => 'required',
                'body' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //  return $data;

            try {

                if ($this->__sendMessage($data['mobile_no'],$data['body'])) {
                    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                            <strong>Message has been sent!! </strong>
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

        return view('admin.message.add');
    }
}
