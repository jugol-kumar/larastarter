<?php

use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\UserController;
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

//Route::get('/dashboard',[
//   'uses' => DashboardController::class,
//   'as'   => 'dashboard'
//]);



Route::get('/dashboard',DashboardController::class)->name('dashboard');

// Roles and User
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// Backups
Route::resource('backups', BackupController::class)->only(['index','store','destroy']);
Route::get('backups/{file_name}', [BackupController::class,'download'])->name('backups.download');
Route::delete('backups', [BackupController::class,'clean'])->name('backups.clean');

// Profiles
Route::get('profile', [ProfileController::class,'index'])->name('profile.index');
Route::put('profile', [ProfileController::class,'update'])->name('profile.update');

// Security
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::put('profile/security', [ProfileController::class,'updatePassword'])->name('profile.password.update');

// pages
Route::resource('pages', PageController::class);

// Menus
Route::resource('menus', MenuController::class)->except(['show']);



Route::group(['as' => 'settings.', 'prefix' => 'settings/'], function (){
   Route::get('/general', [SettingController::class, 'general'])->name('general');
   Route::put('/general', [SettingController::class, 'generalUpdate'])->name('general.update');

   Route::get('/appearance', [SettingController::class, 'appearance'])->name('appearance');
   Route::put('/appearance', [SettingController::class, 'appearanceUpdate'])->name('appearance.update');
});

