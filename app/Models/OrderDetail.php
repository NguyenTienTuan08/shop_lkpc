<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'detail_id';
    protected $fillable = [
        'order_id',
        'MaSP',
        'hinhanh',
        'tensanpham',
        'so_luong',
        'dongia',
        'thanhtien',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
