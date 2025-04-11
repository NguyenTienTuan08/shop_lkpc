<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-indigo-600 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Đăng Nhập</h2>

        <!-- Hiển thị thông báo lỗi nếu có -->
        @if(session('error'))
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded-lg text-center">
            {{ session('error') }}
        </div>
        @endif

        <!-- Hiển thị thông báo thành công nếu có -->
        @if(session('success'))
        <div class="bg-green-100 text-green-600 p-3 mb-4 rounded-lg text-center">
            {{ session('success') }}
        </div>
        <script>
            // Sử dụng SweetAlert để hiển thị thông báo đăng nhập thành công
            Swal.fire({
                title: 'Đăng Nhập Thành Công!',
                text: 'Chúc mừng bạn đã đăng nhập thành công!',
                icon: 'success',
                confirmButtonText: 'Đóng',
                timer: 3000 // Tự động đóng sau 3 giây
            });
        </script>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Tên Tài Khoản</label>
                <input type="text" name="username" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Mật Khẩu</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-700 transition">Đăng Nhập</button>

            <p class="text-center text-gray-600 mt-4">Chưa có tài khoản? <a href="{{ route('register') }}" class="text-blue-600">Đăng ký</a></p>
        </form>
    </div>

</body>

</html>