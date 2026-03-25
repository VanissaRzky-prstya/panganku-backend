<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/test', function(){
    return response()->json([
        'status' => 'success',
        'message' => 'API Laravel jalan'
    ]);
});

Route::get('/products', function(){
    $products = DB::table('produks')->get();
    foreach($products as $p){
        $p->foto_url= 'http://localhost:8000/storage/'.$p->foto;
    }
    return response()->json([
        'status'=>'success',
        'data'=> $products
    ]);
});

Route::get('/cart/add', function(Request $request){
    $id = $request->id;
    $cart = session()->get('cart', []);
    if(isset($cart[$id])){
        $cart[$id]++;
    }else{
        $cart[$id]=1;
    }
    session()->put('cart', $cart);

    return response()->json([
        'status' => 'success'
    ]);
});

Route::get('/cart', function(){
    $cart = session()->get('cart', []);
    $result = [];
    foreach ($cart as $id => $qty) {
        $produk = DB::table('produks')->where('id', $id)->first();
        if ($produk){
            $produk->qty = $qty;
            $produk->subtotal = $produk->harga * $qty;
            $result[] = $produk;
        }
    }

    return response()->json([
        'status' => 'success',
        'data' => $result,
    ]);
});

Route::get('/cart/plus', function(Request $request){
    $id=$request->id;
    $cart=session()->get('cart', []);
    if(isset($cart[$id])){
        $cart[$id]++;
    }
    session()->put('cart', $cart);
    return response()->json([
        'status'=> 'success'
    ]);
});

Route::get('/cart/minus', function(Request $request){
    $id=$request->id;
    $cart=session()->get('cart',[]);
    if(isset($cart[$id])){
        $cart[$id]--;
        if($cart[$id] <= 0){
            unset($cart[$id]);
        }
    }
    session()->put('cart', $cart);
    return response()->json([
        'status' => 'success'
    ]);
});