<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class AdminController extends Controller
{
    // Hiển thị trang Admin Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function showUsers()
    {
        $users = User::all(); // Lấy tất cả người dùng trong cơ sở dữ liệu
        return view('admin.users', compact('users'));
    }
    // Sửa người dùng
    public function editUser($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Người dùng không tồn tại.');
        }

        return view('admin.editUser', compact('user'));
    }

    // Cập nhật người dùng
    public function updateUser(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Người dùng không tồn tại.');
        }

        // Validate dữ liệu từ form
        $request->validate([
            'yourname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'role' => 'required|string|max:20',
        ]);

        // Cập nhật thông tin người dùng
        $user->update([
            'yourname' => $request->yourname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Cập nhật người dùng thành công.');
    }

    // Xóa người dùng
    public function deleteUser($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Người dùng không tồn tại.');
        }

        // Xóa người dùng
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Xóa người dùng thành công.');
    }

    // Hiển thị form thay đổi mật khẩu cho người dùng
    public function changePasswordForm($username)
    {
        $user = User::where('username', $username)->first();
        return view('admin.change-password', compact('user'));
    }

    // Cập nhật mật khẩu cho người dùng
    public function updatePassword(Request $request, $username)
    {
        // Kiểm tra người dùng tồn tại
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin.users')->with('error', 'Người dùng không tồn tại.');
        }

        // Xác thực mật khẩu
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Mã hóa mật khẩu mới và lưu vào cơ sở dữ liệu
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Mật khẩu của người dùng đã được thay đổi.');
    }

    // Hiển thị danh sách đơn hàng
    public function showOrders()
    {
        $orders = Order::with('orderDetails')->orderByDesc('order_date')->get();
        return view('admin.manager_order', compact('orders'));
    }

    // Xem chi tiết đơn hàng
    public function viewOrderDetail($id)
    {
        $order = Order::with('orderDetails')->where('order_id', $id)->first();
        if (!$order) {
            return redirect()->route('admin.orders')->with('error', 'Đơn hàng không tồn tại.');
        }

        return view('admin.order_detail', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'delivery' => 'required|string',
        ]);

        $order = Order::find($id);
        if ($order) {
            $order->status = $request->status;
            $order->delivery = $request->delivery;
            $order->save();
            return redirect()->route('admin.orders')->with('success', 'Cập nhật đơn hàng thành công.');
        }

        return redirect()->route('admin.orders')->with('error', 'Không tìm thấy đơn hàng.');
    }

    // Xóa đơn hàng
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return redirect()->route('admin.orders')->with('success', 'Xóa đơn hàng thành công.');
        }
        return redirect()->route('admin.orders')->with('error', 'Không tìm thấy đơn hàng.');
    }
}
