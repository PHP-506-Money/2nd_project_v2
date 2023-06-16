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

        return view('static');
    }
}
