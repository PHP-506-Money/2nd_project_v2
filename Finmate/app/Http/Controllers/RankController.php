<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RankController extends Controller
{
    public function index($id)
    {
        
        $pointrank = DB::table('users')
        ->select('point','username','userid')
        ->orderBy('point', 'desc')
        ->limit(10)
        ->get();

        $loginrank = DB::table('users')
        ->select('login_count','username','userid')
        ->orderBy('login_count', 'desc')
        ->limit(10)
        ->get();

        $itemdrawrank = DB::table('users')
        ->select('item_draw_count','username','userid')
        ->orderBy('item_draw_count', 'desc')
        ->limit(10)
        ->get();
        
        
        return view('rank')->with('pointrank',$pointrank)->with('loginrank',$loginrank)->with('itemdrawrank',$itemdrawrank);

    }
}
