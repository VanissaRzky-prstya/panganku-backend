@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-6">Keranjang Belanja</h2>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <h3 class="font-semibold mb-2">Tipe Pemesanan</h3>
    <div class="border rounded-lg p-3 cursor-pointer">Pilih tipe pengiriman</div>
</div>
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <div class="flex justify-between items-center mb-2">
        <h3 class="font-semibold">Alamat Pengiriman</h3>
        <a href="#" class="text-green-600 text-sm">Ubah Alamat</a>
    </div>

    <div class="bg-green-100 border rounded-lg p-5">
        <p class="font-semibold text-center">(+) Tambahkan Alamat</p>
        <p class="text-sm text-gray-500 text-center">Belum ada alamat</p>
    </div>
</div>


@if(session('cart')&& count(session('cart')) > 0)
@php
$subtotal = 0;
foreach(session('cart') as $item){
    $subtotal += $item['qty'] * 10000;
}
@endphp
<div class="bg-white rounded-lg shadow p-6">
    <table class="w-full mb-4">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Produk</th>
                <th class="text-center py-2">Jumlah</th>
                <th class="text-right py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $item)
            <tr class="border-b">
                <td class="py-3">Produk ID {{$id}}</td>
                <td class="text-center">{{$item['qty']}}</td>
                <td class="text-right">
                    <form action="/cart/remove/{{$id}}" method="POST">
                        @csrf
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 border-t pt-4 space-y-2">
        <div class="flex justify-between">
            <span>Subtotal</span>
            <span id="subtotal">Rp {{number_format($subtotal)}}</span>
        </div>
        <div class="flex justify-between">
            <span>Ongkir</span>
            <span id="ongkir">Rp 5.000</span>
        </div>
        <div class="flex justify-between font-bold text-lg">
            <span>Total Bayar</span>
            <span id="total">Rp {{number_format($subtotal + 5000)}}</span>
        </div>
    </div>
    <div class="mt-6 text-right">
        <button class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-800">Lanjut Ke Checkout</button>
    </div>
</div>
@else
<div class="bg-white rounded-lg shadow p-6 text-center">
    <p>Keranjang masih kosong X_X</p>
    <a href="/home" class="text-green-600 hover:underline">Belanja Sekarang</a>
</div>
@endif
<script>
    function updateOngkir(){
        const subtotal = {{$subtotal}};
        const pengiriman = document.querySelector('input[name="pengiriman"]:checked').value;
        let ongkir = 0;
        if(pengiriman === 'instan'){
            ongkir = 5000;
        }
        document/getElemenyById('ongkir').innerText = 'Rp' + ongkir.toLocaleString('id-ID');
        document/getElemenyById('total').innerText = 'Rp' + (subtotal + ongkir).toLocaleString('id-ID');
    }
</script>
@endsection