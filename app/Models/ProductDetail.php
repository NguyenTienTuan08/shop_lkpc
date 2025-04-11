<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDetail extends Model
{
    use HasFactory;

    // Định nghĩa bảng
    protected $table = 'products_details';

    // Cột được phép gán
    protected $fillable = [
        'product_id',
        'thongsokythuat',
        'chitietsanpham'
    ];

    // Quan hệ với bảng products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
