<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index(){
        return view('home',[
        'kategoris' => Kategori::all(),
        'produks' => Produk::all(),
        ]);
    }
}

