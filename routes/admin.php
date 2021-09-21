<?php

use Illuminate\Support\Facades\Route;

Route::get('index',[App\Http\Controllers\AdminController::class,'index'])->name('index'); 

