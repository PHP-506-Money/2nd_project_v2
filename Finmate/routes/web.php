<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Route
 * File Name    : web.php
 * History      : v001 0613 Subin.Noh new
 *******************************************/
use App\Http\Controllers\MofinController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Asset;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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



//미들웨어 권한체크
Route::middleware(['guest'])->group(function () {
    
    Route::get('/', function () {
        return redirect('/main');
    });

    Route::get('/main', function () {
        return view('main');
    })->name('main');

    // Users
    Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
    Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('users.login.post');
    
    Route::get('/users/registration', [UserController::class, 'registration'])->name('users.registration');
    Route::post('/users/registrationpost', [UserController::class, 'registrationpost'])->name('users.registration.post');
    Route::get('/users/registration/{userid}', [ApiController::class, 'getUserChk'])->name('users.registration.check');

    Route::get('/users/findid', [UserController::class, 'findid'])->name('users.findid');
    Route::post('/users/findidpost', [UserController::class, 'findidpost'])->name('users.findid.post');
    Route::get('/users/findpw', [UserController::class, 'findpw'])->name('users.findpw');
    Route::post('/users/findpwpost', [UserController::class, 'findpwpost'])->name('users.findpw.post');
    Route::get('/users/updatepw', [UserController::class, 'updatepw'])->name('users.updatepw'); 
    Route::post('/users/updatepwpost', [UserController::class, 'updatepwpost'])->name('users.updatepw.post');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return Redirect('/assets'.'/'.auth()->user()->userid);
    });
    // Users
    Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::get('/users/withdraw', [UserController::class, 'withdraw'])->name('users.withdraw');

    // Account
    Route::get('/assets/{userid}', [AssetController::class, 'index'])->name('assets.index');
    Route::get('/link', [AssetController::class, 'link'])->name('assets.link');
    Route::get('/assets', [AssetController::class, 'store'])->name('assets.store');
    Route::post('/assetspost', [AssetController::class, 'store'])->name('assets.store.post');

    //transaction
    Route::get('/assets/transactions/{userid}', [TransactionController::class, 'index'])->name('transactions.index');
    
    // myinfo
    Route::get('/users/modify', [UserController::class, 'modify'])->name('users.modify');
    Route::post('/users/modifypost', [UserController::class, 'modifypost'])->name('users.modify.post');

    //achieve
    Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
    Route::get('/checkAchievements', [AchievementController::class, 'checkAchievements'])->name('achievements.checkAchievements');
    Route::put('/achievements/{achievementId}/reward', [AchievementController::class, 'receiveAchievementReward'])->name('achievements.reward');
    
    // 예산 설정
    Route::get('/budget/{userid}',[BudgetController::class, 'budget'])->name('budget.get');
    Route::get('/budgetset',[BudgetController::class, 'budgetset'])->name('budgetset.get');
    Route::post('/budget',[BudgetController::class, 'setting'])->name('budget.post');
    Route::put('/budget',[BudgetController::class, 'edit'])->name('budget.put');
    
    // 통계
    Route::get('/static/{userid}' , [StaticController::class, 'static'])->name('static.get');
    
    //목표
    Route::get('/goal/{userid}', [GoalController::class,'index'])->name('goal.index');
    Route::post('/goal/insert/{userid}', [GoalController::class, 'insert'])->name('goal.insert');
    Route::post('/goal/update/{userid}', [GoalController::class, 'update'])->name('goal.update');
    Route::post('/goal/delete/{userid}', [GoalController::class, 'delete'])->name('goal.delete');
    
    //모핀
    Route::get('/mofin/{userid}', [MofinController::class,'index'])->name('mofin.index');
    Route::post('/mofin/post/{userid}', [MofinController::class, 'point'])->name('mofin.point');
    Route::post('/mofin/item/{userno}', [MofinController::class,'item'])->name('mofin.item');
    
    //랭크
    Route::get('/rank/{userid}', [RankController::class,'index'])->name('rank.index');
    Route::get('/users/profile/{userid}', [UserController::class, 'profile'])->name('users.profile');
    Route::post('/users/profilepost', [UserController::class, 'profilepost'])->name('users.profile.post');
    // Route::post('/rank/search', [RankController::class, 'search'])->name('rank.search');
});

Route::get('/unauthorized-access', function () {
    return view('errors.unauthorized');
});

Route::get('/main2', function () {
    return view('main2');
});

Route::fallback(function() {
    return response()->view('errors.404', [], 404);
});

