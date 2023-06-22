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
        
        // ******** v002 add start kim 전체적인 내용 추가
        // 현재 년도
        // $currentYear = date('Y'); 

        // ******** v003 add start kim 년도 변경 추가
        $currentYear = date('Y');

        // ******** v004 add start kim 년도 이동 추가
        // var_dump($req);
        if($req->input('prevYear')){
            $currentYear = date('Y', strtotime($currentYear." -"."1 years"));
        };

        // ******** v004 add end

        // $currentYear = date('Y', strtotime($currentYear." -"."1 years"));
        // var_dump($currentYear);
        // ******** v003 add end

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

        // var_dump($monthStatic);
        
        // 이번달의 시작과 끝
        $startMonth = date( 'Y-m-01' );
        $finMonth = date( 'Y-m-t' );
        
        // 카테고리별 지출
        $catExpenses = DB::select( " select cat.name as category, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        INNER JOIN categories cat ON tran.char = cat.no
        WHERE tran.trantime BETWEEN ? AND ?
        and ass.userid = ?
        and tran.type='1'
        GROUP BY cat.no , cat.name
        ORDER BY consumption desc ", [$startMonth,$finMonth,$userid]);

        // var_dump($catExpenses);
        // var_dump($startMonth);
        // var_dump($finMonth);

        // ******** v003 add start
        $arrResult= [$currentYear];
        // ******** v003 add end

        return view('static')->with('monthrc' , $monthRCStatic)->with('catdata',$catExpenses)->with('monthex',$monthEXStatic)->with('date',$arrResult);

        // ******** v002 add end
    }
}
