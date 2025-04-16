<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Trang thanh toán cho Giỏ hàng
    public function checkoutCart()
    {
        $username = Auth::user()->username;
        $cartItems = DB::table('cart')->where('username', $username)->get();
        return view('member.checkout.checkout', compact('cartItems'));
    }

    // Trang thanh toán cho "Mua Ngay"
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        return view('member.checkout.checkout', compact('product'));
    }

    // Xử lý đặt hàng
    public function placeOrder(Request $request)
    {
        $request->validate([
            'yourname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'payment_method' => 'required',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        $username = Auth::user()->username;
        $paymentDisplay = $request->payment_method === 'cod' ? 'Tiền mặt' : 'Chuyển khoản';

        if ($request->type === 'buy_now') {
            // === MUA NGAY ===
            $product = Product::findOrFail($request->product_id);
            $so_luong = $request->so_luong;
            $thanh_tien = $product->dongia * $so_luong;

            // Tạo đơn hàng
            $order = Order::create([
                'username' => $username,
                'yourname' => $request->yourname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'order_date' => now(),
                'total_price' => $thanh_tien,
                'payment_method' => $paymentDisplay,
                'status' => 'Chờ xác nhận',
                'delivery' => 'Chờ xử lý',
            ]);

            // Thêm chi tiết đơn hàng
            OrderDetail::create([
                'order_id' => $order->order_id,
                'MaSP' => $product->id,
                'so_luong' => $so_luong,
                'dongia' => $product->dongia,
                'thanhtien' => $thanh_tien,
                'tensanpham' => $product->tensanpham,
                'hinhanh' => $product->hinhanh,
            ]);

            // Gán thông tin đơn hàng vào session
            session()->flash('order_info', [
                'yourname' => $request->yourname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $paymentDisplay,
                'tensanpham' => $product->tensanpham,
                'so_luong' => $so_luong,
                'thanhtien' => $thanh_tien,
            ]);
        } elseif ($request->type === 'cart') {
            // === ĐẶT HÀNG TỪ GIỎ HÀNG ===
            $cartItems = DB::table('cart')->where('username', $username)->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
            }

            $tongTien = $cartItems->sum('thanhtien');

            // Tạo đơn hàng từ giỏ hàng
            $order = Order::create([
                'username' => $username,
                'yourname' => $request->yourname,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'order_date' => now(),
                'total_price' => $tongTien,
                'payment_method' => $paymentDisplay,
                'status' => 'Chờ xác nhận',
                'delivery' => 'Chờ xử lý',
            ]);


            // Thêm chi tiết đơn hàng từ giỏ hàng
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'MaSP' => $item->product_id,
                    'so_luong' => $item->so_luong,
                    'dongia' => $item->thanhtien / $item->so_luong,
                    'thanhtien' => $item->thanhtien,
                    'tensanpham' => $item->tensanpham,
                    'hinhanh' => $item->hinhanh,
                ]);
            }

            // Gán thông tin đơn hàng và danh sách sản phẩm vào session
            session()->flash('order_info', [
                'yourname' => $request->yourname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $paymentDisplay,
                'items' => $cartItems->map(function ($item) {
                    return [
                        'tensanpham' => $item->tensanpham,
                        'so_luong' => $item->so_luong,
                        'thanhtien' => $item->thanhtien,
                    ];
                }),
            ]);

            // Xoá giỏ hàng sau khi đặt
            DB::table('cart')->where('username', $username)->delete();
        }

        return redirect()->route('order.success')->with('success', 'Đặt hàng thành công!');
    }

    // Trang hiển thị sau khi đặt hàng
    public function orderSuccess()
    {
        return view('member.checkout.success');
    }

    // Hiển thị danh sách đơn hàng của người dùng
    public function showMyOrders()
    {
        $username = Auth::user()->username;

        $orders = Order::where('username', $username)
            ->with('orderDetails') // Quan hệ 1-n
            ->orderByDesc('order_date')
            ->get();

        return view('member.order_user', compact('orders'));
    }

    // Huỷ đơn hàng
    public function cancelOrder($order_id)
    {
        $order = Order::find($order_id);

        // Kiểm tra tồn tại và trạng thái đơn hàng có thể huỷ
        if ($order && $order->status == 'Chờ xác nhận') {
            $order->status = 'Huỷ';
            $order->delivery = 'Đã huỷ';
            $order->save();

            return redirect()->back()->with('success', 'Huỷ đơn hàng thành công!');
        }

        return redirect()->back()->with('error', 'Không thể huỷ đơn hàng này.');
    }

    // Xoá đơn hàng đã huỷ
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        // Đảm bảo chỉ xoá đơn hàng đã huỷ
        if ($order->status === 'Hủy' && $order->delivery === 'Đã hủy') {
            // Xoá chi tiết đơn hàng trước
            $order->orderDetails()->delete();

            // Xoá đơn hàng
            $order->delete();

            return back()->with('success', 'Đơn hàng đã được xoá thành công.');
        }

        return back()->with('error', 'Chỉ có thể xoá các đơn hàng đã huỷ.');
    }

    public function myOrders()
    {
        $username = Auth::user()->username;
        $orders = Order::with('orderDetails')
            ->where('username', $username)
            ->orderByDesc('order_id')
            ->get();

        return view('member.order_user', compact('orders'));
    }

    public function filterByStatus($status)
    {
        $username = Auth::user()->username;
        $orders = Order::with('orderDetails')
            ->where('username', $username)
            ->where('delivery', $status)
            ->orderByDesc('order_id')
            ->get();

        return view('member.order_user', compact('orders', 'status'));
    }
}
