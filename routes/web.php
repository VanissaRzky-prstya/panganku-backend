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

Route::post('/cart/add/{id}',function($id){
    $cart=session()->get('cart',[]);
    if(isset($cart[$id])){
        $cart[$id]['qty']++;
    }else{
        $cart[$id]=['qty'=>1];
    }
    session()->put('cart',$cart);
});

Route::post('/cart/increase/{id}', function ($id){
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
        session()->put('cart', $cart);
    }
});

Route::post('/cart/decrease/{id}', function ($id){
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['qty']--;
        if ($cart[$id]['qty'] <= 0) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
    }
});

Route::post('/cart/remove/{id}', function ($id){
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);
});

Route::get('/cart/count', function(){
    $cart=session('cart',[]);
    $total=collect($cart)->sum('qty');
    return response()->json(['count'=>$total]);
});

Route::get('/keranjang',function(){
    return view('cart.index');
})->middleware('auth');