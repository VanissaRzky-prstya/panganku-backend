<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

Route::get('/login',[LoginController::class,'show'])->name('login');
Route::post('/login',[LoginController::class,'authenticate']);

Route::get('/register',[RegisterController::class,'show']);
Route::post('/register',[RegisterController::class,'store']);

Route::post('/logout',[LoginController::class,'logout'])->middleware('auth');

Route::get('/',function(){
    return redirect('/home');
});

Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});