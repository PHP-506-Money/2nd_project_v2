<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : StaticController.php
 * History      : v001 0616 Kim new
 *******************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    function static(Request $req , $userid) {
        
        // ******** v002 update start kim 전체적인 내용 추가
        
        // ******** v003 update start kim 년도 변경 추가
        // var_dump($req->year);

        // 현재 년도
        $currentYear = date('Y');
        $lastYear = strval(date('Y') - 1);
        $BlastYear = strval(date('Y') - 2);
        // var_dump($lastYear);
        // var_dump($BlastYear);
        
        if($req->year === $BlastYear) {
            $currentYear = $req->year;
        }
        else if($req->year === $lastYear) {
            $currentYear = $req->year;
        }
        // var_dump($currentYear);
        // ******** v003 update end

        // 월별 입금
        $monthRCStatic = DB::select("
        SELECT DATE_FORMAT(tran.trantime, '%m') AS Month, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        WHERE ass.userid = ? and tran.type = '0' and YEAR(tran.trantime) = ?
        GROUP BY Month ",[$userid,$currentYear]);
        
        // 월별 지출
        $monthEXStatic = DB::select("
        SELECT DATE_FORMAT(tran.trantime, '%m') AS Month, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        WHERE ass.userid = ? and tran.type = '1' and YEAR(tran.trantime) = ?
        GROUP BY Month ",[$userid,$currentYear]);

        // 현재 달
        $currentMonth = date('m');

        // 일별 지출
        $dayEXStatic = DB::select("
        SELECT DATE_FORMAT(tran.trantime, '%d') AS day, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        WHERE ass.userid = ? and tran.type = '1' and YEAR(tran.trantime) = ? and MONTH(tran.trantime) = ?
        GROUP BY day ",[$userid,$currentYear,$currentMonth]);

        // var_dump($monthStatic);
        
        // 이번달의 시작과 끝

        // $startMonth = date( 'Y-m-01' );
        // $finMonth = date( 'Y-m-t' );
        // 이번달의 시작과 마지막날의 형태를 변경
        // $startDate =date('m-d',strtotime($startMonth));
        // $endDate =date('m-d',strtotime($finMonth));
        
        $startDate =date('m-1');
        $endDate =date('m-t');
        $mmonth = date( 'm' );


        // 카테고리별 지출
        // $catExpenses = DB::select( " select cat.name as category, SUM(tran.amount) AS consumption
        // FROM assets ass
        // INNER JOIN transactions tran ON ass.assetno = tran.assetno
        // INNER JOIN categories cat ON tran.char = cat.no
        // WHERE tran.trantime BETWEEN ? AND ?
        // and ass.userid = ?
        // and tran.type='1'
        // GROUP BY cat.no , cat.name
        // ORDER BY consumption desc ", [$startMonth,$finMonth,$userid]);

        $catExpenses = DB::select( " select cat.name as category, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        INNER JOIN categories cat ON tran.char = cat.no
        WHERE Year(tran.trantime) = ?
        and Month(tran.trantime)= ?
        and ass.userid = ?
        and tran.type='1'
        GROUP BY cat.no , cat.name
        ORDER BY consumption desc ", [$currentYear,$mmonth,$userid]);


        // 지출이 없을때 자산 페이지로 이동
        // if(empty($catExpenses)){
        //     return redirect('/static/'.$userid);
        // }

        // if (empty($catExpenses)) {
        //     return redirect('/static/'.$userid)->with('modal',true);
        // }
        if (empty($catExpenses)) {
            return redirect('/achievements')->with('modal',true);
        }

        // var_dump(session());
        // ******** v004 add start kim 퍼센트 추가

        // 현재달의 지출 합계
        $monthEXSum = DB::select("
        SELECT SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        WHERE ass.userid = ? and tran.type = '1' and YEAR(tran.trantime) = ? and Month(tran.trantime)=?
        ",[$userid,$currentYear,$currentMonth]);

        // 달의 합계를 string에서 int 로 바꿔주기
        $resultSum = intval($monthEXSum[0]->consumption);

        // 지출별 퍼센트를 계산하여 배열로 만들어주기
        foreach($catExpenses as $data){
            $catPrice = $data->consumption;
            $catPercent[]= intval(($catPrice/$resultSum)*100);
        }

        // ******** v004 add end

        // var_dump($catExpenses);
        // var_dump($startMonth);
        // var_dump($finMonth);
        // var_dump($monthEXSum);
        // var_dump($catPercent);
        // var_dump($resultSum);

        // ******** v003 update start 배열 변경
        $arrResult= [
            'startDate' => $startDate,
            'endDate' => $endDate];
        
        // var_dump($arrResult);
        // ******** v003 update end

        return view('static', [
            'currentYear' => $currentYear,
            ])
        ->with('monthrc',$monthRCStatic)
        ->with('catdata',$catExpenses)
        ->with('monthex',$monthEXStatic)
        ->with('date',$arrResult)
        ->with('dayex',$dayEXStatic)
        ->with('percent',$catPercent);

        // ******** v002 update end
    }
}
