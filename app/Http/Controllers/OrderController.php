<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request){
        $cart = session('cart');
        $alamat = session('alamat');
        $checkout = session('checkout');
        $pengiriman = session('pengiriman', 'reguler');

        if (!$cart || !$checkout || !$alamat) {
            return redirect('/keranjang')->with('error', 'Data checkout belum lengkap');
        }

        $order = Order::create([
            'user_id'    => auth()->id(),
            'alamat'     => json_encode($alamat),
            'pengiriman' => $pengiriman,
            'subtotal'   => $checkout['subtotal'],
            'ongkir'     => $checkout['ongkir'],
            'total'      => $checkout['total'],
            'status'     => 'pending'
        ]);
        // sementara cart belum kita kosongkan (biar aman)
        // nanti dikosongkan setelah bayar sukses

        return redirect()->route('checkout.pay', $order->id);
    }

}
