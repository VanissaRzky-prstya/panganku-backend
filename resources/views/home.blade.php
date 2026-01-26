@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Halo, {{ auth()->user()->name }} 👋</h2>
<div class="mb-8"><input type="text" placeholder="Cari produk..."class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"></div>
<div class="bg-green-700 max-w-20xl mx-auto px-5 py-2 rounded-lg mb-6">
    <h3 class="text-xl font-semibold mb-4 text-white">Kategori Belanja</h3>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-5 mb-6">
        @foreach($kategoris as $kategori)
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="h-20 bg-gray-200 rounded mb-3 overflow-hidden">
                @if($kategori->image)
                    <img src="{{ asset('storage/'.$kategori->image) }}" class="h-full w-full object-cover">
                @endif
            </div>
            <p class="font-semibold">{{ $kategori->nama_kategori }}</p>
        </div>
        @endforeach
    </div>
</div>


<h3 class="text-xl font-semibold mb-4">Semua Produk</h3>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
    @foreach($produks as $produk)
    <div class="bg-white rounded-lg shadow p-4">
        <div  class="h-32 bg-gray-200 rounded mb-3 overflow-hidden">
            @if($produk->foto)
                <img src="{{ asset('storage/'.$produk->foto) }}" class="h-full w-full object-cover">
            @endif
        </div>
        <p class="font-semibold">{{ $produk->nama_produk }}</p>
        <p class="text-sm text-gray-600">Rp {{ number_format($produk->harga) }}</p>
        <div class="mt-3" id="cart-control-{{$produk->id}}">
            <button onclick="addToCart({{$produk->id}})" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-900 transition">+ keranjang</button>
        </div>
    </div>
    @endforeach
</div> 
@endsection
@section('scripts')
<script>
function renderCart(id, qty){
    if(qty <= 0){document.getElementById(`cart-control-${id}`).innerHTML = `<button onclick="addToCart(${id})" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-900 transition">+ keranjang</button>`;
        return;
    }
    document.getElementById(`cart-control-${id}`).innerHTML=`
    <div class="flex items-center justify-between gap-2 bg-green-100 p-2 rounded">
    <button onclick="removeItem(${id})">🗑️</button>
    <button onclick="decreaseQty(${id})">➖</button>
    <span class="font-semibold">${qty}</span>
    <button onclick="increaseQty(${id})">➕</button>
    </div>
    `;
}
function addToCart(id) {
    fetch(`/cart/add/${id}`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => {
        renderCart(id, 1);
    });
}
function increaseQty(id) {
    fetch(`/cart/increase/${id}`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => {
        let qty = parseInt(document.querySelector(`#cart-control-${id} span`).innerText);
        renderCart(id, qty + 1);
    });
}
function decreaseQty(id) {
    fetch(`/cart/decrease/${id}`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => {
        let qty = parseInt(document.querySelector(`#cart-control-${id} span`).innerText) - 1;
        renderCart(id, qty);
    });
}
function removeItem(id) {
    fetch(`/cart/remove/${id}`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => {
        renderCart(id, 0);
    });
}
</script>
@endsection

