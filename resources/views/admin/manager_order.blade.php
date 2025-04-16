<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // JavaScript để toggle dropdown khi click
        document.addEventListener('DOMContentLoaded', function() {
            const productMenu = document.getElementById('product-menu');
            const toggleButton = document.getElementById('toggle-product-menu');

            toggleButton.addEventListener('click', function() {
                productMenu.classList.toggle('hidden');
            });
        });
    </script>
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
        <h2 class="text-2xl font-bold mb-4 text-gray-700">Quản Lý Đơn Hàng</h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Người đặt</th>
                        <th class="px-6 py-3 text-left">Ngày đặt</th>
                        <th class="px-6 py-3 text-left">Tổng tiền</th>
                        <th class="px-6 py-3 text-left">Trạng thái</th>
                        <th class="px-6 py-3 text-left">Thanh toán</th>
                        <th class="px-6 py-3 text-left">Vận chuyển</th>
                        <th class="px-6 py-3 text-left">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4">{{ $order->order_id }}</td>
                        <td class="px-6 py-4">{{ $order->yourname }}</td>
                        <td class="px-6 py-4">{{ $order->order_date }}</td>
                        <td class="px-6 py-4">{{ number_format($order->total_price) }}đ</td>
                        <td class="px-6 py-4">{{ $order->status }}</td>
                        <td class="px-6 py-4">{{ $order->payment_method }}</td>
                        <td class="px-6 py-4">{{ $order->delivery }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('admin.orders.detail', $order->order_id) }}"
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-500 text-sm">Xem</a>
                            <form action="{{ route('admin.orders.delete', $order->order_id) }}" method="POST"
                                class="inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500 text-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>