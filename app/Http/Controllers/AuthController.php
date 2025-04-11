<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị trang đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'yourname' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tạo người dùng mới với mật khẩu mã hóa
        User::create([
            'username' => $request->username,
            'yourname' => $request->yourname,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // Hiển thị trang đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Kiểm tra vai trò của người dùng và điều hướng
            if (Auth::user()->role == 'Admin') {
                return redirect()->route('admin.dashboard'); // Điều hướng đến dashboard cho admin
            }
            return redirect()->route('home'); // Điều hướng về trang chủ cho member
        }

        return redirect()->back()->with('error', 'Sai thông tin đăng nhập');
    }



    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Đăng xuất thành công');
    }
}
