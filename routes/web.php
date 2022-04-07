<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Auth;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('auth.login');
});
// ------------------------------register---------------------------------------
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'storeUser'])->name('storeUser');
// -----------------------------login-----------------------------------------
Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
// -----------------------------forget password ------------------------------
Route::get('forget-password',[ForgotPasswordController::class,'getEmail'])->name('forget.password');
Route::post('forget-password',[ForgotPasswordController::class,'postEmail'])->name('forgetPassword');
Route::get('reset-password/{token}',[ResetPasswordController::class,'getPassword'])->name('reset.password');
Route::post('reset-password',[ResetPasswordController::class,'updatePassword'])->name('update.password');