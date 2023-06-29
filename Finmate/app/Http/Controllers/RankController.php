<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class RankController extends Controller
{
    public function index($id)
    {
        
        $pointrank = DB::table('users')
        ->select('point','username','userid')
        ->whereNull('deleted_at')
        ->orderBy('point', 'desc')
        ->limit(10)
        ->get();

        $loginrank = DB::table('users')
        ->select('login_count','username','userid')
        ->whereNull('deleted_at')
        ->orderBy('login_count', 'desc')
        ->limit(10)
        ->get();

        $itemdrawrank = DB::table('users')
        ->select('item_draw_count','username','userid')
        ->whereNull('deleted_at')
        ->orderBy('item_draw_count', 'desc')
        ->limit(10)
        ->get();
        
        
        return view('rank')->with('pointrank',$pointrank)->with('loginrank',$loginrank)->with('itemdrawrank',$itemdrawrank);

    }

    // public function search(Request $req){

    //     $usersearch = DB::table('users') 
    // }
}
