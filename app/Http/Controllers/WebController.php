<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class WebController extends Controller
{
    public function index(){
        $produk=Produk::with('kategori')->get();
        return view('web.home', compact('produks'));
    }
}
