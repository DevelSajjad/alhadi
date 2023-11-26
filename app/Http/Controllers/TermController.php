<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermController extends Controller
{
    public function create(){
      $term = Term::where('type','term')->first();
      if ($term != null){
        return to_route('admin.term.view');
      }
      return view('admin.term_condition.add');
    }

    public function view(){
      $term = Term::where('type','term')->first();
      if ($term == null){
        return to_route('admin.term.create');
      }
      return view('admin.term_condition.view', compact('term') );
    }

    public function viewBN(){
      $policy = Term::where('type','policy')->first();
      if ($policy == null){
        return to_route('admin.policy.create');
      }
      return view('admin.refundPolicy.viewBN', compact('policy') );
    }

    public function update(){
      $term = Term::where('type','term')->first();
      if ($term == null){
        return to_route('admin.term.create');
      }
      return view('admin.term_condition.edit', compact('term'));
    }

    public function store(Request $request){
      $message = 'Congratulations!!! Term and condition successfully ';
      if ($request->has('id')) {
        $term = Term::find($request->id);
        $message = $message . ' updated';
      } else {
        $term = new Term();
        $message = $message . ' created';
      }
      $rules['title_en'] = 'required|string';
    //   $rules['title_bn'] = 'required|string';
      $rules['overview'] = 'required|string';
      $rules['description'] = 'required|string';
    //   $rules['description_bn'] = 'required|string';
      $request->validate($rules);

      try {
        $term->title_en = $request->title_en;
        // $term->title_bn = $request->title_bn;
        $term->overview = $request->overview;
        $term->description = $request->description;
        // $term->description_bn = $request->description_bn;
        $term->type = 'term';
        if ($term->save()) {
          return to_route('admin.term.view')->with('message', $message);
        }
        $message = 'Sorry!!! Operation Failed!! ';
        return to_route('admin.term.view')->with('status', $message);
      } catch (\Throwable $th){
        throw $th;
      }

    }

}
