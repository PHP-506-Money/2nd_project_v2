<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : GoalController.php
 * History      : v001 0619 Choi new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{
    public function index($id)
    {   


        
        $results = DB::table('goals')->where('userid', $id)->where('deleted_at', null)->get();
        $idsearch = DB::table('users')->where('userid', $id)->first();
        $userid = $idsearch->userid;
        
        if (count($results) > 0){

            
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
        else{
            return view('goal')->with('data', $results);
        }
    }



    public function insert($userid,Request $Req)
    {
        $userno = User::where('userid', $userid)
            ->pluck('userno')
            ->first();
        $data['userno'] = $userno;
        $data['userid'] = $userid;
        $data['title'] = $Req->title;
        $data['amount'] = $Req->amount;
        $data['startperiod'] = $Req->startperiod;
        $data['endperiod'] = $Req->endperiod;
        $data['created_at'] = now();    
        DB::table('goals')->insert($data);
    
        $results = DB::table('goals')->where('userid', $userid)->where('deleted_at', null)->get();
        $idsearch = DB::table('users')->where('userid', $userid)->first();
        $userid = $idsearch->userid;
        
        if (count($results) > 0){

            
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
        else{
            return view('goal')->with('data', $results);
        }
    }





    public function update($id, Request $Req)
{
    $upinfo = DB::table('goals')->where('userid', $id)->where('goalno', $Req->goalno);

    $updatedData = [
        'title' => $Req->title,
        'amount' => $Req->amount,
        'startperiod' => $Req->startperiod,
        'endperiod' => $Req->endperiod,
        'updated_at' => now()
    ];

    $upinfo->update($updatedData);

    $results = DB::table('goals')->where('userid', $id)->where('deleted_at', null)->get();
    $idsearch = DB::table('users')->where('userid', $id)->first();
    $userid = $idsearch->userid;
    
    if (count($results) > 0){

            
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
    else{
        return view('goal')->with('data', $results);
    }
}





public function delete($id, Request $Req){
    $delinfo = DB::table('goals')->where('userid', $id)->where('goalno', $Req->goalno);
            $delinfo -> update([
            'deleted_at' => now()
        ]);
        $results = DB::table('goals')->where('userid', $id)->where('deleted_at', null)->get();

        $idsearch = DB::table('users')->where('userid', $id)->first();
        $userid = $idsearch->userid;
        
        if (count($results) > 0){

            
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
        else{
            return view('goal')->with('data', $results);
        }

}


}
