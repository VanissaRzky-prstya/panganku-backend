<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request){
        $cart=session('cart', []);
        $alamat=session('alamat', []);
        $pengiriman=session('pengiriman', 'reguler');
        $hari=session('hari');
        $jam=session('jam');
        $catatan= trim ($request->input('catatan'));
        if ($catatan === ''){
            $catatan = null;
        }
        if (empty($cart) || empty($alamat)){
            return redirect('/keranjang')->with('error', 'Data belum lengkap');
        }
        $subtotal = 0;
        foreach ($cart as $item){
            $subtotal += $item['harga'] * $item['qty'];
        }
        $ongkir=$pengiriman === 'instan' ? 5000 : 0;
        $total =$subtotal + $ongkir;
        session([
            'checkout'=>[
                'cart' => $cart,
                'alamat' => $alamat,
                'pengiriman' => $pengiriman,
                'hari' => $hari,
                'jam' => $jam,
                'catatan' => $catatan,
                'subtotal' => $subtotal,
                'ongkir' => $ongkir,
                'total' => $total,
            ]
        ]);
        return redirect()->route('checkout.pay.preview');
    }
}