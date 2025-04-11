<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Sản Phẩm</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <a href="{{ route('admin.dashboard') }}" class="block p-3 rounded bg-blue-700 hover:bg-blue-600">Dashboard</a>
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
        <h1 class="text-3xl font-bold text-gray-700 mb-4" style="text-align:center">Đăng Sản Phẩm</h1>

        <!-- Thông báo nếu có -->
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
            @csrf
            <div class="mb-4">
                <label for="danhmuc" class="block text-sm font-semibold text-gray-700 mb-1">Danh mục</label>
                <select id="danhmuc" name="danhmuc" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Mainboard">Mainboard</option>
                    <option value="CPU">CPU</option>
                    <option value="RAM">RAM</option>
                    <option value="SSD">SSD</option>
                    <option value="VGA">VGA</option>
                    <option value="Case">Case</option>
                    <option value="ManHinh">Màn Hình</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Hình ảnh</label>
                <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-3 py-2 file:bg-blue-100 file:border-none file:rounded file:px-3 file:py-1" required>
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Tên sản phẩm</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Đơn giá</label>
                <input type="number" name="price" id="price" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="phanloai" class="block text-sm font-semibold text-gray-700 mb-1">Phân loại</label>
                <input type="text" name="phanloai" id="phanloai" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Trạng thái</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="con_hang">Còn hàng</option>
                    <option value="het_hang">Hết hàng</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="specifications" class="block text-sm font-semibold text-gray-700 mb-1">Thông số kỹ thuật</label>
                <textarea name="specifications" id="specifications" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Chi tiết sản phẩm</label>
                <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition duration-300">Đăng sản phẩm</button>
            </div>
        </form>

    </main>

</body>

</html>