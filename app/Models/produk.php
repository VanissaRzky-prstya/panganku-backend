<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $fillable=['kategori_id', 'nama_produk', 'deskripsi', 'harga', 'stok', 'foto'];
    public function kategori(){
        return $this->belongsTo(kategori::class);
    }
}
