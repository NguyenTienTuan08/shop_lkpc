<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'danhmuc',
        'hinhanh',
        'tensanpham',
        'dongia',
        'phanloai',
        'status',
    ];
    public function details()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }
}
