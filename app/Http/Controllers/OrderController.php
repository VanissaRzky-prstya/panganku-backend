<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class OrderController extends Controller{
    public function store(Request $request){
        $checkout = session('checkout');
        if (!$checkout){
            return redirect('/keranjang')->with('error', 'Data checkout belum lengkap');
        }

        $payerEmail = auth()->check()
        ? auth()->user()->email
        : 'guest@email.com';
        
        $order = Order::create([
            'user_id' => auth()->id() ?? 1,
            'alamat' => json_encode($checkout['alamat']),
            'cart' => json_encode($checkout['cart']),
            'pengiriman' => $checkout['pengiriman'],
            'subtotal' => $checkout['subtotal'],
            'ongkir' => $checkout['ongkir'],
            'total' => $checkout['total'],
            'status' => 'pending',
            'catatan' => $checkout['catatan'] ?? null,
        ]);
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
        $apiInstance = new InvoiceApi();
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => 'ORDER-' . $order->id . '-' . time(),
            'amount' => $order->total,
            'payer_email' => $payerEmail,
            'description' => 'Pembayaran Pesanan #' . $order->id,
            'success_redirect_url' => url('/payment/success'),
            'failure_redirect_url' => url('/payment/failed'),
        ]);
        $invoice = $apiInstance->createInvoice($createInvoiceRequest);
        $order->update([
            'invoice_id' => $invoice['id']
        ]);
        return redirect($invoice['invoice_url']);
    }
}
