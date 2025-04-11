<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <aside class="w-64 bg-blue-900 text-white min-h-screen px-6 py-4">
        <h2 class="text-2xl font-bold text-center mb-6">Admin Panel</h2>
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="/admin/dashboard" class="block p-3 rounded bg-blue-700 hover:bg-blue-600">Dashboard</a>
                </li>
                <li class="mb-2">
                    <a id="toggle-product-menu" href="javascript:void(0)" class="block p-3 rounded hover:bg-blue-600">Quản lý sản phẩm</a>
                    <!-- Dropdown menu (ban đầu ẩn) -->
                    <ul id="product-menu" class="hidden mt-2 space-y-2 bg-blue-700 text-white">
                        <li>
                            <a href="{{ route('admin.createProduct') }}" class="block px-4 py-2 hover:bg-blue-600">Đăng Sản Phẩm</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products') }}" class="block px-4 py-2 hover:bg-blue-600">Danh Sách Sản Phẩm</a>
                        </li>
                    </ul>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.orders') }}" class="block p-3 rounded hover:bg-blue-600">Quản lý đơn hàng</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.users') }}" class="block p-3 rounded hover:bg-blue-600">Quản lý người dùng</a>
                </li>
                <li class="mt-6">
                    <a href="{{ route('logout') }}" class="block p-3 text-center bg-red-600 rounded hover:bg-red-500">Đăng xuất</a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-700">Chi Tiết Đơn Hàng #{{ $order->order_id }}</h2>

        <div class="bg-white p-6 rounded shadow mb-6">
            <p><strong>Khách hàng:</strong> {{ $order->yourname }}</p>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->order_date }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->sdt }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            <p><strong>Thanh toán:</strong> {{ $order->payment_method }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="text-lg font-semibold mb-4">Danh sách sản phẩm</h3>
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Hình ảnh</th>
                        <th class="px-4 py-2 text-left">Tên sản phẩm</th>
                        <th class="px-4 py-2 text-left">Số lượng</th>
                        <th class="px-4 py-2 text-left">Đơn giá</th>
                        <th class="px-4 py-2 text-left">Thành tiền</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($order->orderDetails as $item)
                    <tr>
                        <td class="px-4 py-2"><img src="{{ asset('images/' . $item->hinhanh) }}" class="w-16"></td>
                        <td class="px-4 py-2">{{ $item->tensanpham }}</td>
                        <td class="px-4 py-2">{{ $item->so_luong }}</td>
                        <td class="px-4 py-2">{{ number_format($item->dongia) }}đ</td>
                        <td class="px-4 py-2">{{ number_format($item->thanhtien) }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-4">Cập nhật đơn hàng</h3>
            <form method="POST" action="{{ route('admin.orders.update', $order->order_id) }}">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Trạng thái</label>
                    <select name="status" class="w-full px-3 py-2 border rounded">
                        <option value="Xác nhận" {{ $order->status == 'Xác nhận' ? 'selected' : '' }}>Xác nhận</option>
                        <option value="Chờ xác nhận" {{ $order->status == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                        <option value="Hủy" {{ $order->status == 'Hủy' ? 'selected' : '' }}>Hủy</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Vận chuyển</label>
                    <select name="delivery" class="w-full px-3 py-2 border rounded">
                        <option value="Chờ xử lý" {{ $order->delivery == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="Đang giao" {{ $order->delivery == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                        <option value="Đã giao" {{ $order->delivery == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                        <option value="Đã hủy" {{ $order->delivery == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500">Cập nhật</button>
            </form>
        </div>

        <a href="{{ route('admin.orders') }}" class="inline-block mt-4 text-blue-600 hover:underline">← Quay lại danh sách</a>
    </main>
</body>

</html>