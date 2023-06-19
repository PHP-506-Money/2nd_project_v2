<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index($id)
    {   

        $result = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();
        return view('goal')->with('data', $result);
    }


    public function insert($id,Request $Req)
    {
        $data['userno'] = $id;
        $data['title'] = $Req->title;
        $data['amount'] = $Req->amount;
        $data['startperiod'] = $Req->startperiod;
        $data['endperiod'] = $Req->endperiod;
        $data['created_at'] = now();    
        DB::table('goals')->insert($data);
    
        $result = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();
    
        return view('goal')->with('data', $result);
    }

    public function update($id, Request $Req)
{
    $upinfo = DB::table('goals')->where('userno', $id)->where('goalno', $Req->goalno);

    $updatedData = [
        'title' => $Req->title,
        'amount' => $Req->amount,
        'startperiod' => $Req->startperiod,
        'endperiod' => $Req->endperiod,
        'updated_at' => now()
    ];

    $upinfo->update($updatedData);

    $result = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();

    return view('goal')->with('data', $result);
}

public function delete($id, Request $Req){
    $delinfo = DB::table('goals')->where('userno', $id)->where('goalno', $Req->goalno);
            $delinfo -> update([
            'deleted_at' => now()
        ]);
        $result = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();

    return view('goal')->with('data', $result);

}

}
