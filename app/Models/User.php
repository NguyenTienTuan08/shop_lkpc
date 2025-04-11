<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'username'; // Đặt username là khóa chính
    public $incrementing = false; // Không tự động tăng
    protected $keyType = 'string'; // Khóa chính là kiểu string

    protected $fillable = [
        'username',
        'yourname',
        'phone',
        'email',
        'address',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
