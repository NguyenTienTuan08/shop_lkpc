<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người Dùng</title>
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
        <h1 class="text-3xl font-bold text-gray-700 mb-4">Quản lý Người Dùng</h1>

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

        <!-- Table of Users -->
        <table class="min-w-full table-auto bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-2 px-4 text-left">Tên Tài Khoản</th>
                    <th class="py-2 px-4 text-left">Họ và Tên</th>
                    <th class="py-2 px-4 text-left">Số điện thoại</th>
                    <th class="py-2 px-4 text-left">Email</th>
                    <th class="py-2 px-4 text-left">Địa chỉ</th>
                    <th class="py-2 px-4 text-left">Vai trò</th>
                    <th class="py-2 px-4 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $user->username }}</td>
                    <td class="py-2 px-4">{{ $user->yourname }}</td>
                    <td class="py-2 px-4">{{ $user->phone }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">{{ $user->address }}</td>
                    <td class="py-2 px-4">{{ $user->role }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('admin.editUser', $user->username) }}" class="text-blue-600 hover:text-blue-800">Sửa</a>
                        |<a href="{{ route('admin.changePassword', $user->username) }}" class="text-yellow-600 hover:text-yellow-800">Đổi mật khẩu</a> |
                        <a href="{{ route('admin.deleteUser', $user->username) }}" class="text-red-600 hover:text-red-800" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">Xóa</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </main>

</body>

</html>