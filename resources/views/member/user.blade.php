<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Hồ sơ tài khoản</h2>

            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
            @endif

            {{-- Form cập nhật thông tin --}}
            <form action="{{ route('member.updateProfile') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="username" class="block font-semibold">Tên đăng nhập</label>
                    <input type="text" name="username" value="{{ Auth::user()->username }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label for="yourname" class="block font-semibold">Họ tên</label>
                    <input type="text" name="yourname" value="{{ Auth::user()->yourname }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label for="phone" class="block font-semibold">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label for="email" class="block font-semibold">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label for="address" class="block font-semibold">Địa chỉ</label>
                    <input type="text" name="address" value="{{ Auth::user()->address }}" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label class="block font-semibold">Vai trò</label>
                    <input type="text" value="{{ Auth::user()->role }}" class="w-full px-4 py-2 border rounded-lg bg-gray-100 text-gray-600" readonly>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Cập nhật</button>
                </div>
            </form>

            {{-- Đổi mật khẩu --}}
            <hr class="my-8 border-t">
            <h3 class="text-xl font-bold mb-4 text-blue-700 text-center">Đổi mật khẩu</h3>

            <form action="{{ route('member.updatePassword') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="current_password" class="block font-semibold">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label for="new_password" class="block font-semibold">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div>
                    <label for="new_password_confirmation" class="block font-semibold">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
    @include('components.footer')
</body>

</html>