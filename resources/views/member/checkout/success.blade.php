<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto mt-10 px-6 py-8 bg-white shadow-lg rounded-lg max-w-2xl">
        <h2 class="text-3xl font-bold text-green-600 mb-4 text-center">🎉 Đặt Hàng Thành Công!</h2>
        <p class="text-gray-700 mb-6 text-center">
            Cảm ơn bạn đã mua hàng tại <strong>KEN STORE</strong>. Đơn hàng của bạn đã được ghi nhận và sẽ sớm được xử lý.
        </p>

        @if(session('order_info'))
        @php $order = session('order_info'); @endphp

        <div class="bg-gray-50 p-4 rounded border mb-6">
            <h3 class="text-xl font-semibold mb-4 text-blue-600">📋 Thông Tin Đơn Hàng</h3>
            <ul class="space-y-2 text-gray-700">
                <li><strong>Khách hàng:</strong> {{ $order['yourname'] }}</li>
                <li><strong>Email:</strong> {{ $order['email'] }}</li>
                <li><strong>Số điện thoại:</strong> {{ $order['phone'] }}</li>
                <li><strong>Địa chỉ:</strong> {{ $order['address'] }}</li>
                <li><strong>Phương thức thanh toán:</strong> {{ $order['payment_method'] }}</li>
            </ul>

            <div class="mt-4">
                @if(isset($order['tensanpham']))
                {{-- Trường hợp MUA NGAY --}}
                <h4 class="font-semibold text-gray-800 mt-4">🛒 Sản phẩm:</h4>
                <ul class="ml-4 mt-2 space-y-1">
                    <li><strong>Tên sản phẩm:</strong> {{ $order['tensanpham'] }}</li>
                    <li><strong>Số lượng:</strong> {{ $order['so_luong'] }}</li>
                    <li><strong>Tổng tiền:</strong>
                        <span class="text-red-600 font-semibold">{{ number_format($order['thanhtien']) }} VNĐ</span>
                    </li>
                </ul>
                @elseif(isset($order['items']))
                {{-- Trường hợp từ GIỎ HÀNG --}}
                <h4 class="font-semibold text-gray-800 mt-4">🛒 Danh sách sản phẩm:</h4>
                <ul class="ml-4 mt-2 space-y-3">
                    @foreach ($order['items'] as $item)
                    <li class="border-b pb-2">
                        <strong>Tên:</strong> {{ $item['tensanpham'] }}<br>
                        <strong>Số lượng:</strong> {{ $item['so_luong'] }}<br>
                        <strong>Thành tiền:</strong>
                        <span class="text-red-600 font-semibold">{{ number_format($item['thanhtien']) }} VNĐ</span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        @endif

        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                ⬅ Quay về Trang Chủ
            </a>
        </div>
    </div>
</body>

</html>