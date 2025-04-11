<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $incrementing = true; // <== Thêm dòng này
    protected $keyType = 'int'; // <== Và dòng này nữa

    protected $fillable = [
        'username',
        'yourname',
        'phone',
        'email',
        'address',
        'order_date',
        'total_price',
        'payment_method',
        'status',
        'delivery',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}
