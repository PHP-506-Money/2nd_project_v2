<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : BudgetController.php
 * History      : v001 0615 Kim new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    function setting() {
        // $result = DB::select('select * from budgets bud inner join assets ass on bud.userid = ass.userid inner join transaction tran on tran.assetno = ass.assetno');
        // $arrsum = DB::select('select sum()');
        
        return view('budget');
    }

    function budget() {
        return redirect('/budget');
    }
}