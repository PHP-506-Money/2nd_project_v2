<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index($userid)
    {   

        $result = DB::table('goals')->where('userid', $userid)->where('deleted_at', null)->get();

        $startdate = $result->startperiod;
        $enddate = $result->endperiod;
        
        

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
// public function complete($id){

//     $result = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();
//     return view('goal')->with('data', $result);


//     $today = date();  // 현재 날짜
//     $day = date('w');
//     $currentYear = date('Y'); // 현재 년도
//     $currentMonth = date('m'); // 현재 달

//     $start = date('Y-m-d', strtotime($today." -".$day."days")); // 이번주 시작요일 계산
//     $end = date('Y-m-d', strtotime($start." +6days")); // 이번주 마지막날 계산
//     $startDate =date('m-d',strtotime($start));  // 형태를 월과 요일로 바꾸기
//     $endDate =date('m-d',strtotime($end));  // 형태를 월과 요일로 바꾸기
// }

}
