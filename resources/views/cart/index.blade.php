@extends('layouts.app')
@section('content')
@php
use Carbon\Carbon;
Carbon::setLocale('id');
$haripengiriman = [];
for ($i = 1; $i <= 3; $i++) {
    $haripengiriman[] = Carbon::now()->addDays($i);
}
@endphp
<h2 class="text-2xl font-bold mb-6">Keranjang Belanja</h2>
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <h3 class="font-semibold mb-2">Tipe Pengiriman</h3>
    <div class="space-y-3">
        <label id="boxInstan" class="block border rounded-lg p-4 cursor-pointer hover:border-green-600" onclick="pilihInstan()">
            <input type="radio" name="pengiriman" value="instan" class="hidden">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold">Pengiriman Instan</p>
                    <p class="text-sm text-gray-500">1 jam setelah pembayaran</p>
                </div>
                <span class="font-semibold text-green-600">Rp 5.000</span>
            </div>
        </label>
        <label id="boxReguler" class="block border rounded-lg p-4 cursor-pointer hover:border-green-600" onclick="pilihReguler()">
            <input type="radio" name="pengiriman" value="reguler" class="hidden">
            <div>
                <p class="font-semibold">Pengiriman Reguler</p>
                <p id="regulerText" class="text-sm text-gray-500">Pilih hari & jam pengiriman</p>
            </div>
            <div id="jadwalReguler" class="hidden mt-4 space-y-4">
                <div class="grid grid-cols-3 gap-4">
                    @foreach($haripengiriman as $hari)
                    <div class="border rounded-lg p-3 text-center cursor-pointer hover:border-green-600 pilih-hari"onclick="pilihHari(event,this,'{{$hari->translatedFormat('l')}} {{$hari->format('d-m-Y')}}')">
                        <p class="font-semibold">{{$hari->translatedFormat('l')}}</p>
                        <p class="text-sm text-gray-500">{{$hari->format('d m y')}}</p>
                    </div>
                    @endforeach
                </div>
                <div class="grid grid-cols-1 gap-3">
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'08.00 - 09.59')">08.00 - 09.59</div>
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'10.00 - 11.59')">10.00 - 11.59</div>
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'13.00 - 14.59')">13.00 - 14.59</div>
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'15.00 - 16.59')">15.00 - 16.59</div>
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'17.00 - 18.59')">17.00 - 18.59</div>
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'19.00 - 20.59')">19.00 - 20.59</div>   
                    <div class="border rounded-lg p-3 cursor-pointer hover:border-green-600 pilih-jam"onclick="pilihJam(event,this,'21.00 - 22.59')">21.00 - 22.59</div>     
                </div>
            </div>
        </label>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    @php
    $alamat = session('alamat');
    @endphp
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>
        @if($alamat)
        <a href="{{route('alamat.form')}}" class="text-green-600 text-sm mb-2 ">Ubah Alamat</a>
        @endif  
    </div>
    @if($alamat)
    <div class="border rounded-lg p-4 bg-green-50">
        <p class="font-semibold">{{ $alamat['nama'] }} ({{ $alamat['hp']}})</p>
        <p class="text-sm text-gray-600">
            {{ $alamat['alamat'] }},
            {{ $alamat['kelurahan'] }},
            {{ $alamat['kecamatan'] }},
            {{ $alamat['kota'] }},
            {{ $alamat['provinsi'] }},
            {{ $alamat['kodepos'] }}
        </p>
    </div>
    @else
    <a href="{{route('alamat.form')}}" class="block bg-green-100 border rounded-lg p-4 text-center hover:bg-green-200 transition">
        <p class="font-semibold">(+) Tambahkan Alamat</p>   
    </a>
    @endif  
</div>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <h3 class="font-semibold mb-2">Catatan Pengiriman📝</h3>
    <textarea class="w-full border rounded-lg p-2 text-gray-500" placeholder="Contoh: taruh di satpam atau depan rumah"></textarea>
</div>
@if(!empty($cart))
<div id="cart-list" class="bg-white rounded-lg shadow p-4 mb-6">
    <div class="flex justify-between items-center mb-4">
        <label class="flex items-center gap-2">
            <h3 class="font-semibold mb-2">List Belanja🛒</h3>
        </label>
    </div>
    @foreach( $cart as $id => $item)
    <div class="cart-item flex items-center gap-4 border-t py-4" data-id="{{ $id }}" data-harga="{{ $item['harga'] }}">
        <input type="checkbox" 
        class="item-check" 
        checked
        onchange="toggleItem(this)">
        <div class="w-20 h-20 bg-gray-200 rounded">
            @if(!empty($item['foto']))
            <img src="{{ asset('storage/'.$item['foto']) }}" class="h-full w-full object-cover">
            @endif
        </div>
        <div class="flex-1">
            <p class="font-semibold">{{ $item ['nama'] }}</p>
            <p class="text-green-600 font-bold">Rp {{ number_format($item['harga']) }}</p>
        </div>
        <div class="flex items-center gap-2" data-harga="{{ $item['harga'] }}">
            <button onclick="decreaseQty({{ $id }})">[➖]</button>
            <span id="qty-{{ $id }}" class="font-bold">{{ $item['qty'] }}</span>
            <button onclick="increaseQty({{ $id }})">[➕]</button>
        </div>
    </div>
    @endforeach
</div>
<form method="POST" action="{{ route('checkout.process') }}">
    @csrf
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-2">Ringkasan Belanja🧾</h3>
        <div class="mt-6 border-t pt-4 space-y-2">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span id="subtotal" data-value="{{ $subtotal }}">Rp {{number_format($subtotal)}}</span>
            </div>
            <div class="flex justify-between">
                <span>Ongkir</span>
                <span id="ongkir">Rp 0</span>
            </div>
            <div class="flex justify-between font-bold text-lg">
                <span>Total Bayar</span>
                <span id="total" data-value="{{$subtotal}}">Rp {{number_format($subtotal)}}</span>
            </div>
        </div>
        <div class="mt-6 text-right">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-800">Lanjut Bayar</button>
        </div>
    </div>
</form>
@else
<div id="empty-cart" class="bg-white rounded-lg shadow p-6 text-center">
    <p>Keranjang masih kosong X_X</p>
    <a href="/home" class="text-green-600 hover:underline">Belanja Sekarang</a>
</div>

@endif
<script>
let selectedHari = null;
let selectedJam = null;
function pilihInstan(){
    selectedHari=null;
    selectedJam=null;
    updateOngkir(5000);
    document.getElementById('regulerText').innerText='Pilih hari & jam pengiriman';
    document.getElementById('jadwalReguler').classList.add('hidden');
    document.querySelectorAll('.pilih-hari, .pilih-jam').forEach(el=>{
        el.classList.remove('border-green-600','bg-green-50');
    });
    document.getElementById('boxInstan').classList.add('border-green-600','bg-green-50');
    document.getElementById('boxReguler').classList.remove('border-green-600','bg-green-50');
    fetch('/pengiriman/instan',{
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    });
}
function pilihReguler(){
    if(!selectedHari || !selectedJam){
        document.getElementById('jadwalReguler').classList.remove('hidden');
         document.getElementById('boxInstan').classList.remove('border-green-600','bg-green-50');
    document.getElementById('boxReguler').classList.remove('border-green-600','bg-green-50');
    }
   
}
function pilihHari(event,el,hari){
    event.stopPropagation();
    selectedHari = hari;
    document.querySelectorAll('.pilih-hari').forEach(item=>{
        item.classList.remove('border-green-600','bg-green-50');
    });
    el.classList.add('border-green-600','bg-green-50');
    cekSelesai();
}
function pilihJam(event,el,jam){
    event.stopPropagation();
    selectedJam = jam;
    document.querySelectorAll('.pilih-jam').forEach(item=>{
        item.classList.remove('border-green-600','bg-green-50');
    });
    el.classList.add('border-green-600','bg-green-50');
    cekSelesai();
}
function cekSelesai(){
    if(selectedHari && selectedJam){
        document.getElementById('regulerText').innerText = selectedHari + ' | ' + selectedJam;
        document.getElementById('jadwalReguler').classList.add('hidden');
        document.getElementById('boxReguler').classList.add('border-green-600','bg-green-50');
        simpanSession();
    }
}
</script>
<script>
function simpanSession(){
    updateOngkir(0);
    fetch('/simpan-jadwal',{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            pengiriman: 'reguler',
            hari: selectedHari,
            jam: selectedJam
        })
    });
}
</script>
<script>
    const sessionPengiriman = "{{ session('pengiriman') }}";
    const sessionHari = "{{ session('hari') }}";
    const sessionJam = "{{ session('jam') }}";

    document.addEventListener('DOMContentLoaded', function () {

    if (sessionPengiriman === 'instan') {
        pilihInstan();
    }

    if (sessionPengiriman === 'reguler' && sessionHari && sessionJam) {

        document.getElementById('boxReguler')
            .classList.add('border-green-600','bg-green-50');

        document.getElementById('boxInstan')
            .classList.remove('border-green-600','bg-green-50');

        document.getElementById('regulerText')
            .innerText = sessionHari + ' • ' + sessionJam;

        document.getElementById('jadwalReguler')
            .classList.add('hidden');
    }
 
});
</script>
<script>
function toggleItem(cb){
    const row = cb.closest('.cart-item');
    const harga = parseInt(row.dataset.harga);
    const qty = parseInt(row.querySelector('[id^="qty-"]').innerText);

    if(cb.checked){
        updateTotal(harga * qty);
    }else{
        updateTotal(-(harga * qty));
    }
}
</script>

<script>
function formatRupiah(num){
    return 'Rp ' + num.toLocaleString('id-ID');
}

function increaseQty(id){
    fetch(`/cart/increase/${id}`,{
        method:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
    })
    .then(res => res.ok && updateUI(id, 1));
}

function decreaseQty(id){
    const itemEl = document.querySelector(`.cart-item[data-id="${id}"]`);
    const qtyEl  = document.getElementById(`qty-${id}`);
    let qty = parseInt(qtyEl.innerText);

    if(qty === 1){
        fetch(`/cart/remove/${id}`,{
            method:'POST',
            headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
        }).then(()=>{
            itemEl.remove();

            // cek apakah masih ada item
            const remaining = document.querySelectorAll('.cart-item');

            if(remaining.length === 0){
                document.getElementById('cart-list').remove();
                document.getElementById('empty-cart').classList.remove('hidden');
                document.querySelector('form[action*="checkout"]').remove();
            }
        });
        return;
    }
    fetch(`/cart/decrease/${id}`,{
        method:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
    }).then(()=>{
        qtyEl.innerText = qty - 1;
    });
}

function updateUI(id, diff){
    const qtyEl = document.getElementById(`qty-${id}`);
    qtyEl.innerText = parseInt(qtyEl.innerText) + diff;
    const row = qtyEl.closest('.cart-item');
    const harga = parseInt(row.dataset.harga);
    const checkbox = row.querySelector('.item-check');

    if(checkbox.checked){
        updateTotal(harga * diff);
    }
}

function updateTotal(diff){
    let subtotalEl = document.getElementById('subtotal');
    let totalEl = document.getElementById('total');

    let subtotal = parseInt(subtotalEl.dataset.value) + diff;
    subtotalEl.dataset.value = subtotal;
    subtotalEl.innerText = formatRupiah(subtotal);

    // total dihitung di updateOngkir saja
    let ongkirText = document.getElementById('ongkir').innerText.replace(/\D/g,'');
    let ongkir = parseInt(ongkirText || 0);

    let total = subtotal + ongkir;
    totalEl.dataset.value = total;
    totalEl.innerText = formatRupiah(total);
}
</script>

<script>
    function updateOngkir(ongkir){
        const subtotalEl = document.getElementById('subtotal');
        const totalEl = document.getElementById('total');
        
        let subtotal = parseInt(subtotalEl.dataset.value);
        let total = subtotal + ongkir;

        document.getElementById('ongkir').innerText = formatRupiah(ongkir);
        totalEl.innerText = formatRupiah(total);
        totalEl.dataset.value = total;
    }
</script>
@endsection