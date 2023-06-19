<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Route
 * File Name    : web.php
 * History      : v001 0613 Subin.No new
 *******************************************/
use App\Http\Controllers\MofinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;
use App\Models\Asset;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/main', function () {
    return view('main');
})->name('main');

//미들웨어 권한체크
Route::middleware(['guest'])->group(function () {
    // Users
    Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
    Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('users.login.post');
    
    Route::get('/users/registration', [UserController::class, 'registration'])->name('users.registration');
    Route::post('/users/registrationpost', [UserController::class, 'registrationpost'])->name('users.registration.post');
    Route::get('/users/registration/{userid}', [ApiController::class, 'getUserChk'])->name('users.registration.check');

    Route::get('/users/findid', [UserController::class, 'findid'])->name('users.findid');
    Route::get('/users/findpw', [UserController::class, 'findpw'])->name('users.findpw');
});

Route::middleware(['auth'])->group(function () {
    // Users
    Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

    // Account
    Route::get('/assets/{userid}', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/link', [AssetController::class, 'link'])->name('assets.link');
    Route::get('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::post('/assetspost', [AssetController::class, 'store'])->name('assets.store.post');

    // myinfo
    Route::get('/users/myinfo', [UserController::class, 'myinfo'])->name('users.myinfo');
});



// // Users
// Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
// Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('users.login.post');
// Route::get('/users/registration', [UserController::class, 'registration'])->name('users.registration');
// Route::post('/users/registrationpost', [UserController::class, 'registrationpost'])->name('users.registration.post');
// Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

// Route::get('/users/registration/{userid}',[ApiController::class,'getUserChk'])->name('users.registration.check');

// Route::get('/users/findid', [UserController::class, 'findid'])->name('users.findid');
// Route::get('/users/findpw', [UserController::class, 'findpw'])->name('users.findpw');

// //계좌
// Route::get('/assets/{userid}', [AssetController::class, 'index'])->name('assets.index');

//모핀
Route::get('/mofin/{id}', [MofinController::class,'index'])->name('mofin.index');

// 예산 설정
Route::get('/budget/{userid}',[BudgetController::class, 'budget'])->name('budget.get');
Route::get('/budgetset',[BudgetController::class, 'budgetset'])->name('budgetset.get');
Route::post('/budget',[BudgetController::class, 'setting'])->name('budget.post');

// 통계
Route::get('/static' , [StaticController::class, 'static']);