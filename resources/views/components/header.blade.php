<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<header class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-white shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex flex-col items-center">
            <a href="/" class="text-3xl font-bold text-white hover:text-yellow-400 hover:scale-105 transition-all duration-300">
                KEN STORE
            </a>
            <span class="text-lg text-yellow-300">Chuyên Linh Kiện PC</span>
        </div>

        <!-- Navigation -->
        <nav class="flex items-center space-x-8">
            <a href="/" class="text-lg hover:text-yellow-300 transition-colors duration-300">Trang Chủ</a>
            <a href="{{ route('about') }}" class="text-lg hover:text-yellow-300 transition-colors duration-300">Giới Thiệu</a>
            <a href="#product" class="text-lg hover:text-yellow-300 transition-colors duration-300">Sản Phẩm</a>
            <a href="/contact" class="text-lg hover:text-yellow-300 transition-colors duration-300">Liên Hệ</a>

            @auth
            <!-- Nếu đã đăng nhập -->
            <div class="relative group">
                <button class="text-lg hover:text-yellow-300 transition-colors duration-300 flex items-center gap-1">
                    Xin chào, {{ Auth::user()->yourname }}
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414l-4.707-4.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div class="absolute right-0 mt-2 w-52 bg-white text-gray-800 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-10">
                    <a href="{{ route('member.profile') }}" class="block px-4 py-2 hover:bg-gray-100">👤 Hồ sơ tài khoản</a>
                    <a href="{{ route('cart.show') }}" class="px-4 py-2 hover:bg-gray-100 flex items-center space-x-1">
                        🛒 <span>Giỏ hàng</span>
                        @if($cartCount > 0)
                        <span class="bg-red-600 text-white text-xs font-bold rounded-full px-1.5 ml-1">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    <a href="{{ route('user.orders') }}" class="block px-4 py-2 hover:bg-gray-100">📦 Đơn hàng của tôi</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100">🚪 Đăng xuất
                    </a>
                </div>
            </div>
            @else
            <!-- Nếu chưa đăng nhập -->
            <a href="{{ route('login') }}" class="bg-green-500 px-5 py-2 rounded-lg text-white hover:bg-green-700 transition-colors duration-300">
                Đăng Nhập
            </a>
            @endauth
        </nav>
    </div>
</header>