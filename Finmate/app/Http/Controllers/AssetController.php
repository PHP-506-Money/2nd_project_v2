<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : AssetController.php
 * History      : v001 0616 Noh new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
{
    public function index($userid)
    {
        $assets = Asset::where('userid', $userid)->get();
        return view('assets', ['assets' => $assets]);
    }
}
