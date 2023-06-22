<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RankController extends Controller
{
    public function index($id)
    {
        
        $result = DB::table('users')
        ->select('point','username')
        ->orderBy('point', 'desc')
        ->limit(10)
        ->get();

        
        return view('rank')->with('data',$result);

    }
}
