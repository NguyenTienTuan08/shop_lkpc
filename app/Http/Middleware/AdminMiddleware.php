<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và là admin
        if (Auth::check() && Auth::user()->role == 'Admin') {
            return $next($request);
        }

        // Nếu không phải Admin, chuyển hướng về trang chủ
        return redirect()->route('home');
    }
}
