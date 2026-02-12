<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request){
        $cart = session('cart');
        $alamat = session('alamat');
        $pengiriman = session('pengiriman', 'reguler');

        if (!$cart || !$alamat) {
            return redirect('/keranjang')->with('error', 'Data belum lengkap');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['qty'];
        }

        $ongkir = $pengiriman === 'instan' ? 5000 : 0;
        $total = $subtotal + $ongkir;

        session([
            'checkout' => [
                'subtotal' => $subtotal,
                'ongkir'   => $ongkir,
                'total'    => $total,
            ]
        ]);

        return redirect()->route('checkout.pay.preview');
    }
}