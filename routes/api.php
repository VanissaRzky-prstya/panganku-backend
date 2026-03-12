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
        $p->foto_url=url('storage/'.$p->foto);
    }
    return response()->json([
        'status'=>'success',
        'data'=> $products
    ]);
});

Route::get('/cart/add', function(Request $request){

    $id = $request->id ?? 1;

    $cart = session()->get('cart', []);

    if(isset($cart[$id])){
        $cart[$id]++;
    } else {
        $cart[$id] = 1;
    }

    session()->put('cart', $cart);

    return response()->json([
        'status' => 'success',
        'product_id' => $id,
        'qty' => $cart[$id]
    ]);
});
