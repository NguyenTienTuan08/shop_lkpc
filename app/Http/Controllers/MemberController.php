<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{

    // Hiển thị trang hồ sơ tài khoản
    public function showProfile()
    {
        return view('member.user');
    }
    // Cập nhật thông tin hồ sơ tài khoản
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->username . ',username',
            'yourname' => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->username . ',username',
            'address'  => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cập nhật dữ liệu
        DB::table('users')->where('username', $user->username)->update([
            'username' => $request->username,
            'yourname' => $request->yourname,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
        ]);

        // Nếu username bị thay đổi -> đăng xuất người dùng hiện tại
        if ($user->username !== $request->username) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Cập nhật thành công. Vui lòng đăng nhập lại.');
        }

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không đúng');
        }

        $user->password = Hash::make($request->new_password);
        $user = Auth::user();


        return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
    }
}
