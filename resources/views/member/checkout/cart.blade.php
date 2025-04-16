<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-2xl font-bold mb-6 text-center">🛒 Giỏ Hàng Của Bạn</h2>

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded text-center">
            {{ session('success') }}
        </div>
        @endif

        @if($cartItems->isEmpty())
        <div class="text-center text-gray-600 text-lg">Hiện tại giỏ hàng của bạn đang trống.</div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow-md">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-6 text-left">Sản Phẩm</th>
                        <th class="py-3 px-6 text-center">Hình Ảnh</th>
                        <th class="py-3 px-6 text-center">Đơn Giá</th>
                        <th class="py-3 px-6 text-center">Số Lượng</th>
                        <th class="py-3 px-6 text-center">Thành Tiền</th>
                        <th class="py-3 px-6 text-center">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $product)
                    <tr class="border-b">
                        <td class="py-4 px-6">{{ $product->tensanpham }}</td>
                        <td class="py-4 px-6 text-center">
                            <img src="{{ asset('images/' . $product->hinhanh) }}" alt="{{ $product->tensanpham }}"
                                class="w-20 h-20 object-cover rounded">
                        </td>
                        <td class="py-4 px-6 text-center">{{ number_format($product->thanhtien / $product->so_luong) }} VNĐ</td>
                        <td class="py-4 px-6 text-center">
                            <input type="number" min="1" value="{{ $product->so_luong }}"
                                data-cart-id="{{ $product->cart_id }}"
                                class="update-quantity w-16 border border-gray-300 rounded px-2 py-1 text-center">
                        </td>
                        <td class="py-4 px-6 text-center font-semibold">{{ number_format($product->thanhtien) }} VNĐ</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('cart.remove', $product->cart_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right font-bold py-4 px-6 bg-gray-50">Tổng Tiền:</td>
                        <td colspan="2" class="text-center font-bold py-4 px-6 bg-gray-50 text-red-600 text-lg">
                            {{ number_format($total) }} VNĐ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-right mt-6">
            <a href="{{ route('checkout.cart') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Thanh Toán
            </a>
        </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.update-quantity').forEach(input => {
            input.addEventListener('change', function() {
                const cartId = this.dataset.cartId;
                const newQuantity = this.value;

                fetch(`/cart/update/${cartId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            so_luong: newQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Reload để cập nhật tổng tiền
                        } else {
                            alert('Có lỗi xảy ra khi cập nhật số lượng!');
                        }
                    });
            });
        });
    </script>


</body>

</html>