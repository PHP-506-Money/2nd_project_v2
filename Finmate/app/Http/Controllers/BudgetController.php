<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    function setting() {
        return view('budgetsetting');
    }

    function budget() {
        return view('budget');
    }
}