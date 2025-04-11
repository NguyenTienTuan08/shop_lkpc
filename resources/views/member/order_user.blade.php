<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng Của Tôi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">📦 Đơn Hàng Của Tôi</h2>

        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
            {{ session('success') }}
        </div>
        @endif

        @if(count($orders) > 0)
        @foreach ($orders as $order)
        <div class="bg-white shadow-md rounded-lg mb-6 p-6 border-l-4 border-blue-600">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">🧾 Mã Đơn: #{{ $order->order_id }}</h3>
                    <p class="text-gray-600">Ngày đặt: {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</p>
                </div>
                <div class="text-right">
                    <span class="text-sm px-3 py-1 rounded-full 
                        {{ $order->status == 'Đã giao' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded">
                <h4 class="font-semibold text-lg mb-2 text-gray-700">🛒 Sản phẩm:</h4>
                <ul class="divide-y divide-gray-200">
                    @foreach ($order->orderDetails as $item)
                    <li class="py-2 flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('images/' . $item->hinhanh) }}" alt="{{ $item->tensanpham }}"
                                class="w-16 h-16 object-cover border rounded">
                            <div>
                                <p class="text-gray-800 font-medium">{{ $item->tensanpham }}</p>
                                <p class="text-sm text-gray-500">Số lượng: {{ $item->so_luong }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-red-600 font-semibold">{{ number_format($item->thanhtien) }} VNĐ</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-4">
                <p><strong>Người nhận:</strong> {{ $order->yourname }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                <p><strong>Thanh toán:</strong> {{ $order->payment_method }}</p>
                <p>
                    <strong>Trạng thái giao hàng:</strong>
                    @if($order->status == 'Chờ xác nhận')
                    <span class="px-2 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-700">
                        Chờ xử lý
                    </span>
                    @else
                    <span class="px-2 py-1 rounded-full text-sm font-semibold
                            {{ $order->delivery == 'Đã giao' ? 'bg-green-200 text-green-800' : 
                            ($order->delivery == 'Đang giao' ? 'bg-yellow-200 text-yellow-800' : 'bg-gray-200 text-gray-700') }}">
                        {{ $order->delivery }}
                    </span>
                    @endif
                </p>
            </div>

            <div class="flex justify-between items-center mt-4">
                <p class="text-lg font-semibold">Tổng tiền:
                    <span class="text-red-600">{{ number_format($order->total_price) }} VNĐ</span>
                </p>

                <div class="flex items-center space-x-2">
                    @if($order->status == 'Chờ xác nhận')
                    <form action="{{ route('cancel.order', $order->order_id) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn huỷ đơn hàng này?');">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-200">
                            ❌ Huỷ Đơn
                        </button>
                    </form>
                    @endif

                    @if($order->status === 'Hủy' && $order->delivery === 'Đã hủy')

                    <form action="{{ route('delete.order', $order->order_id) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn xoá đơn hàng này không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-200">
                            🗑️ Xoá Đơn
                        </button>
                    </form>

                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="bg-white p-6 rounded shadow text-center text-gray-700">
            Bạn chưa có đơn hàng nào.
        </div>
        @endif

        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                ⬅ Quay lại Trang Chủ
            </a>
        </div>
    </div>
</body>

</html>