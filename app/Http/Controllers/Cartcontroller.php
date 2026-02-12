<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class Cartcontroller extends Controller
{
    public function index(){
        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item){
            $subtotal += $item['harga'] * $item['qty'];
        }
        return view('cart.index', compact('cart', 'subtotal'));
    }
    public function add($id){
        $produk=Produk::findOrFail($id);
        $cart=session()->get('cart',[]);
        if(isset($cart[$id])){
            $cart[$id]['qty']++;
        }else{
            $cart[$id]=[
                'id'=>$produk->id,
                'nama'=>$produk->nama_produk,
                'harga'=>$produk->harga,
                'foto'=>$produk->foto,
                'qty'=> 1
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['success'=>true]);
    }
    public function increase($id){
        $cart=session()->get('cart', []);
        if(isset($cart[$id])){
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
        }
        return response()->json(['success'=>true]);
    }
    public function decrease($id){
        $cart=session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['qty']--;
            if($cart[$id]['qty'] <= 0){
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }
        return response()->json(['success'=>true]);
    }
    public function remove($id){
        $cart=session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return response()->json(['success'=>true]);
    }

    public function count(){
        $cart=session()->get('cart', []);
        $count=array_sum(array_column($cart, 'qty'));
        return response()->json(['count'=>$count]);
    }
}
