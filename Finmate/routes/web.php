<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Route
 * File Name    : web.php
 * History      : v001 0613 Subin.No new
 *******************************************/
use App\Http\Controllers\MofinController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


// Users
Route::get('/users/login', [UserController::class, 'login'])->name('users.login');
Route::post('/users/loginpost', [UserController::class, 'loginpost'])->name('users.login.post');
Route::get('/users/registration', [UserController::class, 'registration'])->name('users.registration');
Route::post('/users/registrationpost', [UserController::class, 'registrationpost'])->name('users.registration.post');

Route::get('/users/findid', [UserController::class, 'findid'])->name('users.findid');
Route::get('/users/findpw', [UserController::class, 'findpw'])->name('users.findpw');

//계좌
Route::get('/Accounts/{name}/{id}', [AccountController::class, 'index']);
Route::post('/Accounts/{name}/{id}', [AccountController::class, 'store']);
Route::get('/Accounts/{name}/{id}/{asset}', [AccountController::class, 'show']);
Route::post('/Accounts/{name}/{id}/{asset}', [AccountController::class, 'update']);

//모핀
Route::get('/mofin/{id}', [MofinController::class,'index'])->name('mofin.index');
