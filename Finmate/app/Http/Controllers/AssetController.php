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
use Illuminate\Support\Facades\Hash;

class AssetController extends Controller
{
    public function index($userid)
    {
        $assets = Asset::where('userid', $userid)->get();
        return view('assets', ['assets' => $assets]);
    }

    public function link()
    {
        return view('link');
    }

    Public function store(Request $req){
        $user = auth()->user();
        if($user->userid == $req->input('id') && Hash::check( $user->userpw , $req->input('password')) && $user->username == $req->input('name') && $user->phone == $req->input('phone')){
        //더미 데이터 추가 

        $assetNames = ['토스뱅크', '신한은행', '현대카드', '대구은행', '카카오뱅크', '국민은행', '하나은행'];
        $balanceMin = 100000;
        $balanceMax = 90000000;

            for ($i = 63; $i <= 70; $i++) {
                $asset = new Asset();
                $asset->assetno = $i;
                $asset->userid = $user->userid;
                $asset->assetname = $assetNames[array_rand($assetNames)];
                $asset->balance = mt_rand($balanceMin, $balanceMax);
                $asset->save();
            }

            Return redirect('/')->with('success','연동에 성공했습니다.');
        } else {
            Return redirect('/')->with('error','연동에 실패했습니다. 사용자 정보를 다시 확인해 주세요.');
        }
    }
}
