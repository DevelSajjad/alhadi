<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function view_logs(){
      $logs = DB::table('logs')
        ->join('users', 'users.id', '=', 'logs.user_id')
        ->select('users.name', 'logs.*')
        ->get();
      return view('admin.log.view', compact('logs'));
    }
}
