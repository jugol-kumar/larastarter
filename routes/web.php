<?php

use App\Http\Controllers\PageController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
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

Route::get('/send-sms',[\App\Http\Controllers\Backend\UserController::class, 'sendSms'])->name('sendsms');

Route::get('/', function () {
    return view('welcome');
});

Route::get('sms-verify', [\App\Http\Controllers\Backend\UserController::class, 'goToVerify'])->name('gotoVerify');
Route::post('sms-verify', [\App\Http\Controllers\Backend\UserController::class, 'verifyUser'])->name('verifyUser');
Route::get('sms-resend', [\App\Http\Controllers\Backend\UserController::class, 'resendVerify'])->name('verification.resend');


Route::get('/email', function (){

    Mail::to('jk23717933@gmail.com')->send(new WelcomeMail());

    return new WelcomeMail();
});






Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Page Url Route
Route::get('{slug}', [PageController::class,'index'])->name('page');



