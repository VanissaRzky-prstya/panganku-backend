<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function form()
    {
        return view('alamat.form');
    }

    public function simpan(Request $request)
    {
        // simpan ke SESSION
        session([
            'alamat' => [
                'nama' => $request->nama,
                'hp' => $request->hp,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'kodepos' => $request->kodepos,
            ]
        ]);

        return redirect('/keranjang')->with('success', 'Alamat berhasil disimpan');
    }
}

