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
    function static($userid) {
        
        // v002 add start
        $currentYear = date('Y'); // 현재 년도
        // $year = intval($currentYear);
        $monthStatic = DB::select("
        SELECT DATE_FORMAT(tran.trantime, ?) AS Month, SUM(tran.amount), tran.type
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        WHERE ass.userid = ?
        GROUP BY Month , tran.type ",["$currentYear-%m" , $userid]);
        
        var_dump($monthStatic);
        
        
        $startMonth = date( 'Y-m-01' );
        $finMonth = date( 'Y-m-t' );

        $catExpenses = DB::select( " select cat.name, SUM(tran.amount) AS consumption
        FROM assets ass
        INNER JOIN transactions tran ON ass.assetno = tran.assetno
        INNER JOIN categories cat ON tran.char = cat.no
        WHERE tran.trantime BETWEEN '?' AND '?'
        and ass.userid = ?
        and tran.type='1'
        GROUP BY cat.no
        ORDER BY consumption desc ", [$userid,$startMonth,$finMonth]);

        // var_dump($catExpenses);
        // var_dump($startMonth);
        // var_dump($finMonth);
        var_dump($currentYear);


        return view('static');
        // ->with('data' , $monthStatic);

        // v002 add end
    }
}
