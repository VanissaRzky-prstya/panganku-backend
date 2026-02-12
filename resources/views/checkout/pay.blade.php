@extends('layouts.app')
@section('content')
@php
    $checkout   = session('checkout', []);
    $alamat     = $checkout['alamat'] ?? [];
    $cart       = $checkout['cart'] ?? [];
    $pengiriman = $checkout['pengiriman'] ?? 'reguler';
    $ongkir     = $checkout['ongkir'] ?? 0;
    $subtotal   = $checkout['subtotal'] ?? 0;
    $total      = $checkout['total'] ?? 0;
@endphp
<div class="max-w-3xl mx-auto p-4 space-y-6">
    <h2 class="text-2xl font-bold">Detail Belanja</h2>
    <div class="border rounded p-4">
        <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>
        <p class="font-medium">{{ $alamat['nama']?? '-' }} - {{$alamat['telepon'] ?? '-' }}</p>
        <p class="mt-1">{{ $alamat['alamat'] ?? '-'}}</p>
        @if(!empty($alamat['catatan']))
        <p class="text-sm text-gray-500 mt-2">Catatan: {{ $alamat['catatan'] }}</p>
        @endif
    </div>
    <div class="border rounded p-4">
        <h3 class="font-semibold mb-2">Metode Pengiriman</h3>
        @if($pengiriman === 'instan')
            <p class="text-green-600 font-medium">⚡ Pengiriman Instan</p>
            <p class="text-sm text-gray-500">Dikirim hari ini (1–2 jam)</p>
        @else
            <p class="font-medium">🚚 Pengiriman Reguler</p>
            <p class="text-sm text-gray-500">
                Estimasi 2–3 hari (08.00 – 17.00)
            </p>
        @endif
    </div>
    <div class="border rounded p-4 space-y-4">
    <h3 class="font-semibold">Produk Dipesan</h3>

    @if(!empty($cart) && count($cart) > 0)

        @foreach($cart as $item)
            <div class="flex items-center gap-4 border-b pb-4 last:border-0">

                <img 
                    src="{{ isset($item['gambar']) ? asset('storage/'.$item['gambar']) : asset('img/default.png') }}"
                    class="w-16 h-16 object-cover rounded"
                >

                <div class="flex-1">
                    <p class="font-medium">{{ $item['nama'] ?? '-' }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $item['qty'] ?? 0 }} pcs x 
                        Rp{{ number_format($item['harga'] ?? 0) }}
                    </p>
                </div>

                <div class="font-semibold">
                    Rp{{ number_format(($item['qty'] ?? 0) * ($item['harga'] ?? 0)) }}
                </div>
            </div>
        @endforeach

    @else
        <p class="text-sm text-gray-500">Tidak ada produk</p>
    @endif
</div>

    <div class="border rounded p-4 space-y-2">
        <div class="flex justify-between">
            <span>Subtotal</span>
            <span>Rp{{ number_format($subtotal) }}</span>
        </div>
        <div class="flex justify-between">
            <span>Ongkir</span>
            <span>Rp{{ number_format($ongkir) }}</span>
        </div>
        <div class="flex justify-between font-bold text-lg">
            <span>Total</span>
            <span class="text-green-600">Rp{{ number_format($total) }}</span>
        </div>
    </div>
    <form action="{{ route('checkout.order') }}" method="POST">
        @csrf
        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded text-lg font-semibold">Bayar Sekarang</button>
    </form>
</div>
@endsection





