<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : ApiController.php
 * History      : v001 0616 Kim new
 *******************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    function static($id) {
        
        
        // SELECT DATE_FORMAT(trantime,'2023-%m') AS DATE ,SUM(amount) FROM transactions GROUP BY date;
        return view('static');
    }
}
