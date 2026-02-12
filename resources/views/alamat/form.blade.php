@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Alamat Pengiriman</h2>
    @php
    $alamat = session('alamat');
    @endphp
    <form method="POST" action="{{ route('alamat.simpan') }}">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <h3 class="font-semibold">Nama Penerima</h3>
            <input name="nama" type="text" class="border rounded p-2" value="{{ $alamat['nama'] ?? '' }}">
            <h3 class="font-semibold">Nomor HP</h3>
            <input name="hp" type="text" class="border rounded p-2" value="{{ $alamat['hp'] ?? '' }}">
            <h3 class="font-semibold">Alamat Lengkap</h3>
            <textarea name="alamat" class="border rounded p-2">{{ $alamat['alamat'] ?? '' }}</textarea>
            <h3 class="font-semibold">Provinsi</h3>
            <input name="provinsi" type="text" class="border rounded p-2" value="{{ $alamat['provinsi'] ?? '' }}">
            <h3 class="font-semibold">Kota/Kabupaten</h3>
            <input name="kota" type="text" class="border rounded p-2" value="{{ $alamat['kota'] ?? '' }}">
            <h3 class="font-semibold">Kecamatan</h3>
            <input name="kecamatan" type="text" class="border rounded p-2" value="{{ $alamat['kecamatan'] ?? '' }}">
            <h3 class="font-semibold">Kelurahan</h3>
            <input name="kelurahan" type="text" class="border rounded p-2" value="{{ $alamat['kelurahan'] ?? '' }}">
            <h3 class="font-semibold">Kode POS</h3>
            <input name="kodepos" type="text" class="border rounded p-2" value="{{ $alamat['kodepos'] ?? '' }}">

            <button type="submit" class="bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Simpan Alamat
            </button>

        </div>
    </form>

</div>
@endsection
