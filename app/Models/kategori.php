<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable=['nama_kategori', 'deskripsi', 'foto'];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
