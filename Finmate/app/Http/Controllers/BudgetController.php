<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : BudgetController.php
 * History      : v001 0615 Kim new
 *******************************************/
namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BudgetController extends Controller
{
    function budget($userid) {
        // id의 해당하는 설정한 예산금액을 가져온다.
        // $monthBudget = DB::table('budgets')->select('budgetprice')->where('userid',$userid)->get();

        // ******** v002 add start kim 값받아오는 get에서 value로 방식 수정
        $monthBudget = DB::table('budgets')->where('userid', $userid)->value('budgetprice');
        // ******** v002 add end

        // 예산이 비어있으면 에러메세지와 함께 설정페이지로 간다.
        // if(empty($monthBudget[0])) {
        if(empty($monthBudget)) {
            // $error = "예산을 설정해주세요!";
            // return redirect()->route('budgetset.get')->with('error', "예산을 설정해주세요!");
            return redirect('/budgetset')->with('error', "예산을 설정해주세요!");
        }

        // 날짜계산
        $today = date('Y-m-d');  // 현재 날짜
        $day = date('w');

        // $startDate = date('Y-m-d', strtotime('last Monday', strtotime($today))); 
        // $endDate = date('Y-m-d', strtotime('next Sunday', strtotime($today)));
        $currentYear = date('Y'); // 현재 년도
        $currentMonth = date('m'); // 현재 달
        // $arrDate = [$startDate,$endDate,$currentMonth];
        
        // ******** v002 add start kim 날짜받아오는 방식 수정
        // 이번주 일요일~토요일 계산
        $start = date('Y-m-d', strtotime($today." -".$day."days"));
        $end = date('Y-m-d', strtotime($start." +6days"));
        // 형태를 월과 요일로 바꾸기
        $startDate =date('m-d',strtotime($start));
        $endDate =date('m-d',strtotime($end));

        $currentDay = date('d'); // 현재 달

        // ******** v003 delete kim 내용 삭제
        // if($currentDay === 1 ) {
        // }
        // ******** v002 add end
        // ******** v003 


        // 한달동안 지출한 금액의 합계
        $sumAmount = DB::table('assets')
        ->join('transactions','assets.assetno','=','transactions.assetno')
        ->where('assets.userid',$userid)
        ->where('transactions.type','1')
        ->whereMonth('transactions.trantime',$currentMonth)
        ->whereYear('transactions.trantime',$currentYear)
        ->sum('transactions.amount');

        // 이번주 동안 지출한 금액의 합계
        $sumWeekAmount = DB::table('assets')
        ->join('transactions','assets.assetno','=','transactions.assetno')
        ->where('assets.userid',$userid)
        ->where('transactions.type','1')
        ->whereBetween('transactions.trantime',[$start,$end])
        ->sum('transactions.amount');

        // 한달예산에서 주간예산 구하기
        // $weekBudget = (intval($monthBudget[0]->budgetprice))/4;
        // ******** v002 add start kim 값받아오는 방식 변경 후 수정
        $weekBudget = (intval($monthBudget))/4;
        // ******** v002 add end

        // // 주간금액 중에 남은 금액 구하기
        $usebudget = (intval($sumWeekAmount));
        $leftBudget = $weekBudget-$usebudget;

        // // 설정된 예산 , 한달지출금액 , 주간예산 , 주간지출합계 , 남은주간예산 을 배열로 만든다.
        // $arrResult = [$monthBudget[0],$sumAmount,$weekBudget,$sumWeekAmount,$leftbudget,$arrDate];

        // var_dump($monthBudget);
        // var_dump($sumamount);
        // var_dump($weekBudget);
        // var_dump($arrResult);
        // var_dump($sumWeekAmount);
        // var_dump($_SESSION);
        // var_dump(session('id'));
        // var_dump($monthBudget);
        // var_dump($today);
        // var_dump($arrResult);

        // ******** v002 add start kim 배열 변경
        $arrResult = [$startDate,$endDate,$currentMonth,$weekBudget,$leftBudget];

        // var_dump($arrResult);
    
        // return view('budget')->with('item',$arrResult);
        return view('budget')->with('all',$monthBudget)->with('sumamount',$sumAmount)->with('sumweek',$sumWeekAmount)->with('data',$arrResult);
        // ******** v002 add end
    }

    // 예산 설정 페이지로
    function budgetset() {
        $user = auth()->user()->userid;
        $existingBudget = Budget::find($user);

        return view('budgetsetting', compact('existingBudget'));
    }

    function setting(Request $req) {
        $user = auth()->user()->userid;

        $req->validate([
            'budgetprice' => 'required'
        ]);

        $date = Carbon::now();
        DB::insert('insert into budgets (userid,budgetprice,created_at,updated_at) values (?,?,?,?)', [$user,$req->budgetprice, $date, $date]);

        return redirect('/budget/'.$user);
    }

    function edit(Request $req) {
        $user = auth()->user()->userid;

        $req->validate([
            'budgetprice' => 'required'
        ]);

        $date = Carbon::now();
        DB::update('update budgets set budgetprice = ? , created_at = ?, updated_at = ? where userid = ?', [$req->budgetprice, $date, $date, $user]);

        return redirect('/budget/'.$user);
    } 
}