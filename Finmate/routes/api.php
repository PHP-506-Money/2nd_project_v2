<?php

use App\Http\Controllers\AssetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use app\Models\Asset;
use app\Models\Transaction;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/users/check_achievements', [UserController::class, 'checkAchievements'])->middleware('auth:api')->name('users.checkAchievements');


// Route::get('/Accounts/{userid}', function (Request $request, $userid) {
//     // 해당 사용자의 자산 목록을 데이터베이스에서 가져오는 로직
//     $accounts = [
//         [
//             'assetname' => '계좌명',
//             'balance' => '잔액',
//             'transactions' => [
//                 [
//                     'type' => '거래유형',
//                     'payee' => '거래처',
//                     'amount' => '금액',
//                     'category' => '카테고리',
//                     'time' => '거래시간'
//                 ]
//             ]
//         ]
//     ];

//     // 해당 사용자의 자산 목록을 반환
//     return response()->json($accounts);
// });

// // 자산을 생성하는 엔드포인트 (관리자 권한 필요)
// Route::post('/Accounts/{userid}', function (Request $request, $userid) {
//     // 관리자 권한 체크 로직
//     if (!$request->user()->isAdmin()) {
//         return response()->json(['message' => '관리자만 접근할 수 있습니다.'], 403);
//     }

//     // 자산 생성 로직
//     // 요청으로부터 받은 데이터
//     $assetData = $request->only(['assetname', 'balance']);

//     // 자산 생성
//     $asset = new Asset();
//     $asset->userid = $userid;
//     $asset->assetname = $assetData['assetname'];
//     $asset->balance = $assetData['balance'];
//     $asset->save();


//     return response()->json(['message' => '자산이 생성되었습니다.']);
// });

// // /Accounts/{userid}/{assetname} 엔드포인트:
// // 자산의 내역 목록을 반환하는 엔드포인트
// Route::get('/Accounts/{userid}/{assetname}', function (Request $request, $userid, $assetname) {
//     // 해당 사용자 및 자산명에 대한 자산 내역을 데이터베이스에서 가져오는 로직
//     $transactions = [
//         [
//             'type' => '거래유형',
//             'payee' => '거래처',
//             'amount' => '금액',
//             'category' => '카테고리',
//             'time' => '거래시간'
//         ],

//     ];

//     // 해당 사용자 및 자산명에 대한 자산 내역 목록을 반환
//     return response()->json($transactions);
// });

// // 자산 내역을 생성하는 엔드포인트 (관리자 권한 필요)
// Route::post('/Accounts/{userid}/{assetname}', function (Request $request, $userid, $assetname) {
//     // 관리자 권한 체크 로직
//     if (!$request->user()->isAdmin()) {
//         return response()->json(['message' => '관리자만 접근할 수 있습니다.'], 403);
//     }

//     // 자산 내역 생성 로직
//     // 요청으로부터 받은 데이터
//     $transactionData = $request->only(['type', 'payee', 'amount', 'category', 'time']);

//     // 자산 내역 생성
//     $transaction = new Transaction();
//     $transaction->userid = $userid;
//     $transaction->assetname = $assetname;
//     $transaction->type = $transactionData['type'];
//     $transaction->payee = $transactionData['payee'];
//     $transaction->amount = $transactionData['amount'];
//     $transaction->category = $transactionData['category'];
//     $transaction->time = $transactionData['time'];
//     $transaction->save();


//     return response()->json(['message' => '자산 내역이 생성되었습니다.']);
// });

// // 자산 내역의 카테고리를 업데이트하는 엔드포인트 (관리자 권한 필요)
// Route::put('/Accounts/{userid}/{assetname}', function (Request $request, $userid, $assetname) {
//     // 관리자 권한 체크 로직
//     if (!$request->user()->isAdmin()) {
//         return response()->json(['message' => '관리자만 접근할 수 있습니다.'], 403);
//     }

//     // 카테고리 업데이트 로직
//     // 요청으로부터 받은 데이터
//     $categoryData = $request->only(['category']);

//     // 해당 사용자와 자산명에 맞는 자산 내역을 가져오고, 카테고리 업데이트
//     $transaction = Transaction::where('userid', $userid)
//         ->where('assetname', $assetname)
//         ->first();

//     if ($transaction) {
//         $transaction->category = $categoryData['category'];
//         $transaction->save();
//         return response()->json(['message' => '카테고리가 업데이트되었습니다.']);
//     } else {
//         return response()->json(['message' => '해당 자산 내역을 찾을 수 없습니다.'], 404);
//     }

// });
