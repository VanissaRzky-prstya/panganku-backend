<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Cartcontroller;
use Illuminate\Http\Request;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

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

Route::get('/keranjang',[Cartcontroller::class, 'index'])
->name('cart.index')
->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}',[Cartcontroller::class, 'add']);
    Route::post('/cart/increase/{id}',[Cartcontroller::class, 'increase']);
    Route::post('/cart/decrease/{id}',[Cartcontroller::class, 'decrease']);
    Route::post('/cart/remove/{id}',[Cartcontroller::class, 'remove']);
    Route::get('/cart/count',[Cartcontroller::class, 'count']);
});

Route::post('/simpan-jadwal', function (Request $request){
    session([
        'pengiriman' => $request->pengiriman,
        'hari' => $request->hari,
        'jam' => $request->jam,
    ]);

    return response()->json([
        'status' => 'ok',
        'session'=> session()->all()
        ]);
});

Route::post('/pengiriman/instan', function () {
    session()->forget(['hari', 'jam']);
    session(['pengiriman' => 'instan']);

    return response()->json(['status' => 'ok']);
});

Route::get('/alamat/form',[AlamatController::class, 'form'])
->name('alamat.form')
->middleware('auth');

Route::post('/alamat/simpan', [AlamatController::class, 'simpan'])
    ->name('alamat.simpan');

Route::post('/checkout', [CheckoutController::class, 'process'])
->name('checkout.process')
->middleware('auth');

Route::get('/checkout/pay/{order}', [OrderController::class, 'pay'])
    ->name('checkout.pay')
    ->middleware('auth');

Route::post('/checkout/order', [OrderController::class, 'store'])
    ->name('checkout.order')
    ->middleware('auth');

Route::get('/checkout/confirm', function () {
    return view('checkout.pay');
})->name('checkout.pay.preview')->middleware('auth');
