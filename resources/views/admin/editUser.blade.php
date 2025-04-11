<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Người Dùng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h1 class="text-3xl font-bold text-gray-700 mb-4">Sửa Người Dùng</h1>

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

        <form action="{{ route('admin.updateUser', $user->username) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="yourname" class="block text-gray-700">Tên</label>
                <input type="text" name="yourname" id="yourname" value="{{ old('yourname', $user->yourname) }}" class="mt-1 block w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Số điện thoại</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700">Địa chỉ</label>
                <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700">Vai trò</label>
                <select name="role" id="role" class="mt-1 block w-full px-4 py-2 border rounded" required>
                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Member" {{ old('role', $user->role) == 'Member' ? 'selected' : '' }}>Member</option>
                </select>
            </div>


            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Cập nhật</button>
        </form>
    </main>

</body>

</html>