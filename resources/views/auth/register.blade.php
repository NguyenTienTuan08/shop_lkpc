<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-400 via-purple-500 to-pink-500 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg">
        <h2 class="text-3xl font-semibold text-center text-indigo-600 mb-6">Đăng Ký Tài Khoản</h2>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>
        <div class="text-center">
            <a href="{{ route('login') }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Đăng nhập
            </a>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Họ và Tên</label>
                <input type="text" name="yourname" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Số Điện Thoại</label>
                <input type="text" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Địa Chỉ</label>
                <input type="text" name="address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Tên Tài Khoản</label>
                <input type="text" name="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Mật Khẩu</label>
                <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-gray-800 font-medium">Xác Nhận Mật Khẩu</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">Đăng Ký</button>

            <p class="text-center text-gray-600 mt-4">Đã có tài khoản? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Đăng nhập</a></p>
        </form>
    </div>

</body>

</html>