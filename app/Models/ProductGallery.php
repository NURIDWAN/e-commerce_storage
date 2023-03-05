<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relasikan antar tabel gallery produk dengan produk
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
