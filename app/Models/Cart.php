<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'username',
        'tensanpham',
        'hinhanh',
        'so_luong',
        'thanhtien',
    ];

    // Liên kết với model Product (nếu cần)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Liên kết với model User theo username
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
