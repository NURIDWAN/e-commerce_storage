<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relasi dgn province
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    // relasi dng city
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    // relasi district
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    // relasi dngn user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relasi produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_qty');
    }
}
