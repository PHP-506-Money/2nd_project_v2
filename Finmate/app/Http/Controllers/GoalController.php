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
        
        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $id) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }
        // goals 테이블에서 userid로 삭제되지않은 전체 목표출력
        $results = DB::table('goals')->where('userid', $id)->where('deleted_at', null)->where('completed_at', null)->get();
        // $idsearch = DB::table('users')->where('userid', $id)->first();/********0623 del ***/ userid 로 통일
        // $userid = $idsearch->userid;  /********0623 del ***/ userid 로 통일
        $result1 = DB::table('goals')->where('userid', $id)->where('deleted_at', null)->where('completed_at','>','0000-00-00')->get();
        if (count($results) > 0){

            
            foreach ($results as $result) {
                $startdate = $result->startperiod;
                $enddate = $result->endperiod;
                //시작일자와 마감일자 사이의 수입을 $income에 담아줌
                $income = DB::table('transactions as tran')
                ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
                ->where('ass.userid', $id)
                ->where('tran.type', '0')
                ->whereBetween('tran.trantime', [ $startdate, $enddate])
                ->sum('tran.amount');
                
                //시작일자와 마감일자 사이의 지출을 $outcome에 담아줌

                $outcome = DB::table('transactions as tran')
                ->join('assets as ass', 'tran.assetno', '=', 'ass.assetno')
                ->where('ass.userid', $id)
                ->where('tran.type', '1')
                ->whereBetween('tran.trantime', [ $startdate, $enddate])
                ->sum('tran.amount');

                // 만약 수입에서 지출을 뺀 금액이 목표금액보다 높을경우 완료로 업데이트
                if ($income - $outcome >= $result->amount) {
                    DB::table('goals')->where('goalno', $result->goalno)->update(['completed_at' => now()]);

                }
                // 수입에서 지출을 뺀뒤 $goalint 에 담아줍니다
                $goalint[] = $income-$outcome ;
                }
            return view('goal')->with('data', $results)->with('goalint',$goalint)->with('data1',$result1);
        }
        else{
            return view('goal')->with('data', $results)->with('data1',$result1);
        }
    }



    public function insert($id,Request $Req)
    {
        // 유효성 체크
        $Req->validate([
            'amount'   => 'numeric|min:100000|max:1000000000',
            'startperiod' => 'required|date',
            'endperiod'   => 'required|date|after:startperiod'
        ]);
        
        $userno = User::where('userid', $id)
            ->pluck('userno')
            ->first();
        $data['userno'] = $userno;
        $data['userid'] = $id;
        $data['title'] = $Req->title;
        $data['amount'] = $Req->amount;
        $data['startperiod'] = $Req->startperiod;
        $data['endperiod'] = $Req->endperiod;
        $data['created_at'] = now();    
        DB::table('goals')->insert($data); // request 받은값을 등록해줍니다
    
        return redirect()->route('goal.index', ['userid' => $id]);
    }





    public function update($id, Request $Req)
{
    $Req->validate([
        'amount'   => 'numeric|min:100000|max:1000000000',
        'startperiod' => 'required|date',
        'endperiod'   => 'required|date|after:startperiod'
    ]);
    
    $upinfo = DB::table('goals')->where('userid', $id)->where('goalno', $Req->goalno);
    $updatedData = [
        'title' => $Req->title,
        'amount' => $Req->amount,
        'startperiod' => $Req->startperiod,
        'endperiod' => $Req->endperiod,
        'updated_at' => now()
    ];

    $upinfo->update($updatedData); //request 받은값을 업데이트 해줍니다

    return redirect()->route('goal.index', ['userid' => $id]);
}





public function delete($id, Request $Req){
        //request 받은 goalno있는 데이터를 삭제 플래그 추가합니다
        $delinfo = DB::table('goals')->where('userid', $id)->where('goalno', $Req->goalno);
            $delinfo -> update([
            'deleted_at' => now()
        ]);
        
        return redirect()->route('goal.index', ['userid' => $id]);


}


}
