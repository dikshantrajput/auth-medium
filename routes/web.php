<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test-after-auth',function(){
    return "<h1>Auth</h1>";
})->middleware('auth');

Route::get('/email/verify',function(){
    return view('email.verification-notice');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware'=>['auth','role:ADMIN,SUPER_ADMIN']],function(){
    Route::get('/admin/dashboard',function(){
        return '<h1>Admin Panel</h1>';
    });
});

Route::group(['middleware'=>'auth'],function(){
    Route::post('user/data',[App\Http\Controllers\UserController::class,'getData'])->name('user.data'); 
    Route::post('user/avatar/upload',[App\Http\Controllers\UserController::class,'storeAvatar'])->name('user.avatar.upload'); 
    Route::get('user/ageRestrictedPage',[App\Http\Controllers\UserController::class,'ageRestrictedPage'])->name('age.restricted.page')->middleware('age.check'); 
});