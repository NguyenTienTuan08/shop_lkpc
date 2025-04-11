<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay Đổi Mật Khẩu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white min-h-screen px-6 py-4">
        <h2 class="text-2xl font-bold text-center mb-6">Admin Panel</h2>
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="block p-3 rounded hover:bg-blue-600">Dashboard</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('admin.users') }}" class="block p-3 rounded bg-blue-700 hover:bg-blue-600">Quản lý người dùng</a>
                </li>
                <li class="mt-6">
                    <a href="{{ route('logout') }}" class="block p-3 text-center bg-red-600 rounded hover:bg-red-500">Đăng xuất</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-3xl font-bold text-gray-700 mb-4">Thay Đổi Mật Khẩu Người Dùng</h1>

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
        @elseif(session('error'))
        <script>
            Swal.fire({
                title: "Lỗi!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>
        @endif

        <!-- Form thay đổi mật khẩu -->
        <form action="{{ route('admin.updatePassword', $user->username) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Mật khẩu mới</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-4 py-2 border rounded" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cập nhật mật khẩu</button>
        </form>
    </main>

</body>

</html>