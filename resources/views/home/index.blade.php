@extends('layouts.app')
@section('content')
<h2 class="text-2xl font-bold mb-6">Halo, {{ auth()->user()->name }} 👋</h2>
<input type="text" placeholder="Cari produk..." class="w-full border rounded-lg px-4 py-3 mb-8"/>

<h3 class="text-xl font-semibold mb-4">Kategori Belanja</h3>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
    @foreach(['Beras','Minyak','Sayur','Buah'] as $kategori)
    <div class="bg-white p-4 rounded-lg shadow text-center">
        <div class="h-24 bg-gray-200 mb-3 rounded"></div>
            <p class="font-semibold">{{ $kategori }}</p>
        </div>
    @endforeach
</div>

<h3 class="text-xl font-semibold mb-4">Semua Produk</h3>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="h-40 bg-gray-200 mb-3 rounded"></div>
        <p class="font-semibold">Bayam Hijau</p>
        <p class="text-green-600 font-bold">Rp 3.000</p>
        <button class="mt-3 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Tambah ke Keranjang</button>
    </div>
</div>
@endsection
