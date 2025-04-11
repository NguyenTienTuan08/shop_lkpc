<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $username = Auth::user()->username;

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $existingCart = Cart::where('username', $username)
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            // Nếu đã có thì tăng số lượng
            $existingCart->so_luong += 1;
            $existingCart->thanhtien = $existingCart->so_luong * $product->dongia;
            $existingCart->save();
        } else {
            // Nếu chưa có thì tạo mới
            Cart::create([
                'product_id' => $product->id,
                'username' => $username,
                'hinhanh' => $product->hinhanh,
                'tensanpham' => $product->tensanpham,
                'so_luong' => 1,
                'thanhtien' => $product->dongia,
            ]);
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }
    public function showCart()
    {
        $username = Auth::user()->username;
        $cartItems = Cart::where('username', $username)->get();
        $total = $cartItems->sum('thanhtien');

        return view('member.checkout.cart', compact('cartItems', 'total'));
    }
    public function removeItem($id)
    {
        $username = Auth::user()->username;

        // Dùng cart_id để xóa
        Cart::where('cart_id', $id)
            ->where('username', $username)
            ->delete();

        return redirect()->route('cart.show')->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng.');
    }

    public function updateQuantityAjax(Request $request, $id)
    {
        $validated = $request->validate([
            'so_luong' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::find($id);
        if ($cartItem) {
            $donGia = $cartItem->thanhtien / $cartItem->so_luong;
            $cartItem->so_luong = $validated['so_luong'];
            $cartItem->thanhtien = $validated['so_luong'] * $donGia;
            $cartItem->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function checkout()
    {
        $username = session('username'); // hoặc auth()->user()->username nếu bạn dùng Auth
        $cartItems = Cart::where('username', $username)->get();
        $total = $cartItems->sum('thanhtien');

        return view('member.checkout.checkout', compact('cartItems', 'total'));
    }
}
