<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Asset;

class AssetController extends Controller
{
    public function index($userid)
    {
        $assets = Asset::where('userid', $userid)->get();
        return response()->json(['assets' => $assets]);
    }
}
