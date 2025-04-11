<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <!-- Sidebar -->
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

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-gray-700 mb-4">Chào mừng, {{ Auth::user()->yourname }}!</h1>

        <!-- Thông báo nếu có -->
        @if(session('success'))
        <script>
            Swal.fire({
                title: "Thành công!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>
        @endif

        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Danh Sách Sản Phẩm</h2>

            <table class="min-w-full border bg-white rounded-lg shadow">
                <thead>
                    <tr class="bg-blue-900 text-white">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Tên sản phẩm</th>
                        <th class="px-4 py-2 border">Hình ảnh</th>
                        <th class="px-4 py-2 border">Đơn giá</th>
                        <th class="px-4 py-2 border">Phân loại</th>
                        <th class="px-4 py-2 border">Trạng thái</th>
                        <th class="px-4 py-2 border">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $product->id }}</td>
                        <td class="border px-4 py-2">{{ $product->tensanpham }}</td>
                        <td class="border px-4 py-2">
                            <img src="{{ asset('images/' . $product->hinhanh) }}" class="w-16 h-16 object-cover mx-auto">
                        </td>
                        <td class="border px-4 py-2">{{ number_format($product->dongia) }} VNĐ</td>
                        <td class="border px-4 py-2">{{ $product->phanloai }}</td>
                        <td class="border px-4 py-2">
                            @if($product->status == 'con_hang')
                            <span class="text-green-600 font-semibold">Còn hàng</span>
                            @else
                            <span class="text-red-600 font-semibold">Hết hàng</span>
                            @endif
                        </td>

                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE') <!-- Đảm bảo phương thức DELETE được gửi -->
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Xoá</button>
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