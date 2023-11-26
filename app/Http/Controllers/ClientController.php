<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ClientController extends Controller
{

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            //   return $data;
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'logo' => 'required|mimes:jpeg,png,jpg,webp|max:800',
                'url' => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //  return $data;

            if ($request->hasFile('logo')) {
                $path2 = 'clients_logo/';
                $image2 = $request->file('logo');
                $name2 = time() . '.' . $image2->getClientOriginalExtension();
                $img = Image::make($image2->path());
                $logo = $path2 . $name2;
                $img->resize(100, 100)->save(public_path('/clients_logo/' . $name2));
                // $img->save(public_path('/clients_logo/' . $name2));
            }

            try {
                $clientInfo = [
                    'name' => $data['name'],
                    'logo' => $logo,
                    'url'  => $data['url']
                ];

                if (Client::create($clientInfo)) {
                    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                        <strong>Congratulation!! </strong> New client successfully added!!.
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
        return view('admin.clients.add');
    }

    public function edit(Request $request, $id = Null)
    {
        $client = Client::find($id);
        $old_image_path = public_path($client->logo);
        $logo = '';

        // return $post;
        if ($request->isMethod('POST')) {
            $data = $request->all();

            //   return $data;
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'logo' => 'required|mimes:jpeg,png,jpg,webp|max:800',
                'url'  => 'nullable'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //  return $data;

            if ($request->hasFile('logo')) {
                $path2 = 'clients_logo/';
                $image2 = $request->file('logo');
                $name2 = time() . '.' . $image2->getClientOriginalExtension();
                $img = Image::make($image2->path());
                $logo = $path2 . $name2;
                $img->resize(100, 100)->save(public_path('/clients_logo/' . $name2));
                // $img->save(public_path('/gallery_images/' . $name2));
            }

            try {
                $clientsData = [
                    'name' => $data['name'],
                    'logo' => $logo,
                    'url'  => $data['url']
                ];

                if (Client::where('id', $id)->update($clientsData)) {
                    if (file_exists($old_image_path)) {
                        @unlink($old_image_path);
                    }

                    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                        <strong>Congratulation!! </strong> Client Data updated successful.
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
        return view('admin.clients.edit', compact('client'));
    }

    public function view()
    {
        $clients = Client::orderBy('name', 'ASC')->get();

        return view('admin.clients.view', compact('clients'));
    }

    public function delete(Request $request)
    {
        if ($request->isMethod('DELETE')) {
            $id = $request->post('id');
            $client = Client::find($id);
            if ($client->delete()) {
                $old_image_path1 = public_path($client->logo);
                if (file_exists($old_image_path1)) {
                    @unlink($old_image_path1);
                }
                return 'success';
            }
        }
    }
}
