<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index($id)
    {   


        
        $results = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();
        $idsearch = DB::table('users')->where('userno', $id)->first();
        $userid = $idsearch->userid;
        
        foreach ($results as $result) {
            $startdate = $result->startperiod;
            $enddate = $result->endperiod;
            $income = DB::table('transactions as tran')
            ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
            ->where('ass.userid', $userid)
            ->where('tran.type', '0')
            ->whereBetween('tran.trantime', [ $startdate, $enddate])
            ->sum('tran.amount');
    
            $outcome = DB::table('transactions as tran')
            ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
            ->where('ass.userid', $userid)
            ->where('tran.type', '1')
            ->whereBetween('tran.trantime', [ $startdate, $enddate])
            ->sum('tran.amount');

            if ($income - $outcome >= $result->amount) {
                DB::table('goals')->where('goalno', $result->goalno)->update(['completed_at' => now()]);

            }
            $goalint[] = $income-$outcome ;
    }
        return view('goal')->with('data', $results)->with('goalint',$goalint);
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
    
        $results = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();
        $idsearch = DB::table('users')->where('userno', $id)->first();
        $userid = $idsearch->userid;
        
        foreach ($results as $result) {
            $startdate = $result->startperiod;
            $enddate = $result->endperiod;
            $income = DB::table('transactions as tran')
            ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
            ->where('ass.userid', $userid)
            ->where('tran.type', '0')
            ->whereBetween('tran.trantime', [ $startdate, $enddate])
            ->sum('tran.amount');
    
            $outcome = DB::table('transactions as tran')
            ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
            ->where('ass.userid', $userid)
            ->where('tran.type', '1')
            ->whereBetween('tran.trantime', [ $startdate, $enddate])
            ->sum('tran.amount');
            $goalint[] = $income-$outcome ;
        }
        return view('goal')->with('data', $results)->with('goalint',$goalint);
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

    $results = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();
    $idsearch = DB::table('users')->where('userno', $id)->first();
    $userid = $idsearch->userid;
    
    foreach ($results as $result) {
        $startdate = $result->startperiod;
        $enddate = $result->endperiod;
        $income = DB::table('transactions as tran')
        ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
        ->where('ass.userid', $userid)
        ->where('tran.type', '0')
        ->whereBetween('tran.trantime', [ $startdate, $enddate])
        ->sum('tran.amount');

        $outcome = DB::table('transactions as tran')
        ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
        ->where('ass.userid', $userid)
        ->where('tran.type', '1')
        ->whereBetween('tran.trantime', [ $startdate, $enddate])
        ->sum('tran.amount');
        $goalint[] = $income-$outcome ;
    }
        return view('goal')->with('data', $results)->with('goalint',$goalint);
}





public function delete($id, Request $Req){
    $delinfo = DB::table('goals')->where('userno', $id)->where('goalno', $Req->goalno);
            $delinfo -> update([
            'deleted_at' => now()
        ]);
        $results = DB::table('goals')->where('userno', $id)->where('deleted_at', null)->get();

        $idsearch = DB::table('users')->where('userno', $id)->first();
        $userid = $idsearch->userid;
        
        foreach ($results as $result) {
            $startdate = $result->startperiod;
            $enddate = $result->endperiod;
            $income = DB::table('transactions as tran')
            ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
            ->where('ass.userid', $userid)
            ->where('tran.type', '0')
            ->whereBetween('tran.trantime', [ $startdate, $enddate])
            ->sum('tran.amount');
    
            $outcome = DB::table('transactions as tran')
            ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
            ->where('ass.userid', $userid)
            ->where('tran.type', '1')
            ->whereBetween('tran.trantime', [ $startdate, $enddate])
            ->sum('tran.amount');
            $goalint[] = $income-$outcome ;
        }
        return view('goal')->with('data', $results)->with('goalint',$goalint);

}


}
