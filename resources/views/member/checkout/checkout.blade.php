<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('components.header')

    @php
    $user = Auth::user();
    @endphp

    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg max-w-3xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Thông Tin Đặt Hàng</h2>

        {{-- Trường hợp MUA NGAY --}}
        @if(isset($product))
        <div class="mb-6 border-b pb-4">
            <h3 class="text-lg font-semibold mb-2">Sản phẩm bạn chọn:</h3>
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/' . $product->hinhanh) }}" alt="{{ $product->tensanpham }}"
                    class="w-24 h-24 object-cover rounded">
                <div>
                    <p class="font-medium">{{ $product->tensanpham }}</p>
                    <p class="text-gray-600">Giá:
                        <span class="font-semibold text-red-600">
                            {{ number_format($product->dongia) }} VNĐ
                        </span>
                    </p>

                    <div class="mt-2">
                        <label class="block font-medium">Số lượng</label>
                        <input type="number" name="so_luong" id="so_luong" value="1" min="1"
                            class="w-24 border px-3 py-2 rounded" oninput="updateThanhTien()">
                    </div>

                    <div class="mt-2">
                        <p class="font-medium">Thành tiền:
                            <span id="thanh_tien_text" class="text-red-600">
                                {{ number_format($product->dongia) }} VNĐ
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Form đặt hàng --}}
        <form action="{{ route('order.place') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nếu là mua ngay --}}
            @if(isset($product))
            <input type="hidden" name="type" value="buy_now">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="dongia" id="dongia" value="{{ $product->dongia }}">
            <input type="hidden" name="so_luong" id="hidden_so_luong" value="1">
            <input type="hidden" name="thanh_tien" id="thanh_tien" value="{{ $product->dongia }}">
            @endif

            {{-- Nếu là thanh toán giỏ hàng --}}
            @if(isset($cartItems) && !$cartItems->isEmpty())
            <input type="hidden" name="type" value="cart">

            <div class="mb-6 border-b pb-4">
                @php
                $tongTien = 0;
                @endphp

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border rounded shadow">

                        <tbody>
                            @foreach ($cartItems as $item)
                            @php
                            $thanhTien = $item->thanhtien;
                            $tongTien += $thanhTien;
                            @endphp

                            <div class="flex items-center space-x-4 mb-4 border p-3 rounded">
                                <img src="{{ asset('images/' . $item->hinhanh) }}" alt="{{ $item->tensanpham }}"
                                    class="w-20 h-20 object-cover rounded">
                                <div class="flex-1">
                                    <p class="font-medium">{{ $item->tensanpham }}</p>
                                    <p class="text-gray-600">Giá:
                                        <span class="text-red-600 font-semibold">{{ number_format($item->thanhtien / $item->so_luong) }} VNĐ</span>
                                    </p>
                                    <p class="text-gray-600">Số lượng: <span class="font-semibold">{{ $item->so_luong }}</span></p>
                                    <p class="text-gray-600">Thành tiền:
                                        <span class="text-red-600 font-semibold">{{ number_format($item->thanhtien) }} VNĐ</span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right font-bold py-3 px-4 bg-gray-50">Tổng Tiền:</td>
                                <td class="text-center font-bold py-3 px-4 bg-gray-50 text-blue-700 text-lg">
                                    {{ number_format($tongTien) }} VNĐ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <input type="hidden" name="tong_tien_cart" value="{{ $tongTien }}">
            </div>
            @endif


            @if ($user)
            <div>
                <label class="block font-medium">Họ Tên</label>
                <input type="text" name="yourname" value="{{ $user->yourname }}" required
                    class="w-full border px-4 py-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Số Điện Thoại</label>
                <input type="text" name="phone" value="{{ $user->phone }}" required
                    class="w-full border px-4 py-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                    class="w-full border px-4 py-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Địa Chỉ Giao Hàng</label>
                <textarea name="address" rows="3" required class="w-full border px-4 py-2 rounded">{{ $user->address }}</textarea>
            </div>
            @else
            <p class="text-red-600 font-medium">Vui lòng <a href="{{ route('login') }}" class="underline">đăng nhập</a> để đặt hàng.</p>
            @endif

            <div>
                <label class="block font-medium">Phương Thức Thanh Toán</label>
                <select name="payment_method" class="w-full border px-4 py-2 rounded">
                    <option value="cod">Thanh toán khi nhận hàng</option>
                    <option value="bank">Chuyển khoản ngân hàng</option>
                </select>
            </div>


            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Xác Nhận Đặt Hàng
                </button>
            </div>
        </form>
    </div>

    {{-- Script cập nhật thành tiền --}}
    @if(isset($product))
    <script>
        function updateThanhTien() {
            const dongia = parseInt(document.getElementById('dongia').value);
            const soluong = parseInt(document.getElementById('so_luong').value);
            const thanhTien = dongia * soluong;

            document.getElementById('thanh_tien_text').innerText = new Intl.NumberFormat().format(thanhTien) + ' VNĐ';
            document.getElementById('hidden_so_luong').value = soluong;
            document.getElementById('thanh_tien').value = thanhTien;
        }
    </script>
    @endif

</body>

</html>