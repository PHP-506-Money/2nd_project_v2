<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index($id)
    {   

        $result = DB::table('goals')->where('userno', $id)->get();
        return view('goal')->with('data', $result);
    }


    public function insert($id,Request $Req)
    {
        $data['userno'] = $id;
        $data['title'] = $Req->title;
        $data['amount'] = $Req->amount;
        $data['startperiod'] = $Req->startperiod;
        $data['endperiod'] = $Req->endperiod;
    
        DB::table('goals')->insert($data);
    
        $result = DB::table('goals')->where('userno', $id)->get();
    
        return view('goal')->with('data', $result);
    }
}
