<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : StaticController.php
 * History      : v001 0616 Kim new
 *******************************************/

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    function static( $userid) {

        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $userid) {
            return redirect('/unauthorized-access');
        }

        $assetchk = DB::table('assets')->where('userid', $userid)->count();
        if($assetchk === 0){
            return view('static',[
                'assetchk' => $assetchk]);
        }

        // 현재 년도
        $currentYear = date('Y');

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

        // 카테고리별 지출
        $catExpenses = DB::select( " select cat.name as category, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        INNER JOIN categories cat ON tran.char = cat.no
        WHERE Year(tran.trantime) = ?
        and Month(tran.trantime)= ?
        and ass.userid = ?
        and tran.type='1'
        GROUP BY cat.no , cat.name
        ORDER BY consumption desc ", [$currentYear,$currentMonth,$userid]);

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
        if(!empty($catExpenses)){
            foreach($catExpenses as $data){
                $catPrice = $data->consumption;
                $catPercent[]= intval(round(($catPrice/$resultSum)*100));
        }}

        if(isset($catPercent) && $assetchk !== 0){
        return view('static', [
            'currentYear' => $currentYear,
            'mmonth' => $currentMonth,
            'year' => $currentYear,
            'assetchk' => $assetchk
            ])
            ->with('monthrc',$monthRCStatic)
            ->with('catdata',$catExpenses)
            ->with('monthex',$monthEXStatic)
            ->with('dayex',$dayEXStatic)
            ->with('percent',$catPercent);
            }
            else{
                return view('static', [
                    'currentYear' => $currentYear,
                    'mmonth' => $currentMonth,
                    'year' => $currentYear,
                    'assetchk' => $assetchk
                    ])
                    ->with('monthrc',$monthRCStatic)
                    ->with('catdata',$catExpenses)
                    ->with('monthex',$monthEXStatic)
                    ->with('dayex',$dayEXStatic);
                    }
        }

    // }
}
