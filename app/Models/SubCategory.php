<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug',
    ];


    // relasi antar tabel category dengan subcategory
    // 1 kategori boleh memiliki lebih dr 1 sub kategori dan sebaliknya
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
