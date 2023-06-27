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
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index($userid)
    {
        $assets = Asset::where('userid', $userid)->get();

        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $userid) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }

        return view('assets', ['assets'=>$assets]);
    }

    public function link()
    {
        return view('link');
    }

    Public function store(Request $req){
        $user = auth()->user();
        if($user->userid == $req->input('id') && Hash::check($req->input('password'), $user->userpw ) && $user->username == $req->input('name') && $user->phone == $req->input('phone')){
        //더미 데이터 추가 
        $assetCount = Asset::count();
        $assetNames = ['토스뱅크', '신한은행', '현대카드', '대구은행', '카카오뱅크', '국민은행', '하나은행'];
        $balanceMin = 100000;
        $balanceMax = 90000000;

            for ($i = $assetCount; $i <= $assetCount+10; $i++) {
                $asset = new Asset();
                $asset->assetno = $i;
                $asset->userid = $user->userid;
                $asset->assetname = $assetNames[array_rand($assetNames)];
                $asset->balance = mt_rand($balanceMin, $balanceMax);
                $asset->save();
            }

            $assetNos = range($assetCount, $assetCount+10);
            $types = ['0', '1'];
            $payeeChars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $amountMin = 1000;
            $amountMax = 900000;
            $transNamesDeposit = ['용돈', '계좌입금', '알바비', '아빠', '엄마'];
            $transNamesWithdraw = ['배민', '요기요', '쿠팡', '에이블리', '올리브영', '버스', '지하철', '마트', '편의점'];

            for ($i = 1; $i <= 50;
                $i++
            ) {
                $transaction = new Transaction();
                $transaction->assetno = $assetNos[array_rand($assetNos)];
                $transaction->type = $types[array_rand($types)];
                $transaction->trantime = Carbon::now()->subYear()->addDays(rand(0, 365));
                if($transaction->type == '0'){
                    $transaction->payee = $transNamesDeposit[array_rand($transNamesDeposit)];
                }else {
                    $transaction->payee = $transNamesWithdraw[array_rand($transNamesWithdraw)];
                }
                $transaction->amount = mt_rand($amountMin, $amountMax);
                $transaction->char = $payeeChars[array_rand($payeeChars)];
                $transaction->save();
            }

            Return redirect('/link')->with('success','연동에 성공했습니다. 창을 닫고 새로고침 해주세요.');
        } else {
            Return redirect('/link')->with('error','연동에 실패했습니다. 사용자 정보를 다시 확인해 주세요.');
        }
    }
}
