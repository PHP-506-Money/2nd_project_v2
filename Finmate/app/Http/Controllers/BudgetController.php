<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : BudgetController.php
 * History      : v001 0615 Kim new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    function budget($userid) {
        // id의 해당하는 설정한 예산금액을 가져온다.
        $monthBudget = DB::table('budgets')->select('budgetprice')->where('userid',$userid)->get();

        // 예산이 비어있으면 에러메세지와 함께 설정페이지로 간다.
        if(empty($monthBudget[0])) {
            $error = "예산을 설정해주세요!";
            return redirect()->route('budgetset.get')->with('error', $error);
        }

        // 날짜계산
        $today = date('Y-m-d');  // 현재 날짜
        $startDate = date('Y-m-d', strtotime('last Monday', strtotime($today))); // 이번 주 월요일 날짜를 계산
        $endDate = date('Y-m-d', strtotime('next Sunday', strtotime($today))); // 이번 주 일요일 날짜를 계산
        $currentYear = date('Y'); // 현재 년도
        $currentMonth = date('m'); // 현재 달
        $arrDate = [$startDate,$endDate,$currentMonth];

        // 한달동안 지출한 금액의 합계
        $sumAmount = DB::table('assets')
        ->join('transactions','assets.assetno','=','transactions.assetno')
        ->where('assets.userid',$userid)
        ->where('transactions.type','0')
        ->whereMonth('transactions.trantime',$currentMonth)
        ->whereYear('transactions.trantime',$currentYear)
        ->sum('transactions.amount');

        // 이번주 동안 지출한 금액의 합계
        $sumWeekAmount = DB::table('assets')
        ->join('transactions','assets.assetno','=','transactions.assetno')
        ->where('assets.userid',$userid)
        ->where('transactions.type','0')
        ->whereBetween('transactions.trantime',[$startDate,$endDate])
        ->sum('transactions.amount');

        // 한달예산에서 주간예산 구하기
        $weekBudget = (intval($monthBudget[0]->budgetprice))/4;

        // 주간금액 중에 남은 금액 구하기
        $usebudget = (intval($sumWeekAmount));
        $leftbudget = $weekBudget-$usebudget;

        // 설정된 예산 , 한달지출금액 , 주간예산 , 주간지출합계 , 남은주간예산 을 배열로 만든다.
        $arrResult = [$monthBudget[0],$sumAmount,$weekBudget,$sumWeekAmount,$leftbudget,$arrDate];

        // var_dump($monthBudget[0]);
        // var_dump($sumamount);
        // var_dump($weekBudget);
        // var_dump($arrResult);
        // var_dump($sumWeekAmount);
        // var_dump($_SESSION);
        // var_dump(session('id'));

        // data 로 예산페이지로 보낸다.
        return view('budget')->with('data',$arrResult);
    }

    // 예산 설정 페이지로
    function budgetset() {
        return view('budgetsetting');
    }

    function setting(Request $req) {
        $req->validate([
            'budgetprice' => 'required'
        ]);

        $date = Carbon::now();
        DB::insert('insert into budgets (userid,budgetprice,created_at,updated_at) values (?,?,?,?)', ['',$req->budgetprice, $date, $date]);

        return redirect('/budget');
    }
}