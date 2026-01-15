@extends('layouts.app')

@section('content')
    <!-- Greeting -->
    <h2 class="text-2xl font-bold mb-6">
        Halo, {{ auth()->user()->name }} 👋
    </h2>

    <!-- Search -->
    <div class="mb-8">
        <input 
            type="text" 
            placeholder="Cari produk..."
            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
        >
    </div>

    <!-- Kategori -->
    <h3 class="text-xl font-semibold mb-4">Kategori Belanja</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @foreach(['Beras','Minyak','Sayur','Buah'] as $kategori)
            <div class="bg-white rounded-lg shadow p-4 text-center hover:shadow-md transition">
                <div class="h-20 bg-gray-200 rounded mb-3"></div>
                <p class="font-semibold">{{ $kategori }}</p>
            </div>
        @endforeach
    </div>

    <!-- Produk -->
    <h3 class="text-xl font-semibold mb-4">Semua Produk</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
            <div class="h-32 bg-gray-200 rounded mb-3"></div>
            <p class="font-semibold">Bayam Hijau</p>
            <p class="text-sm text-gray-600 mb-2">Rp 3.000</p>
            <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                + Keranjang
            </button>
        </div>
    </div>
@endsection
