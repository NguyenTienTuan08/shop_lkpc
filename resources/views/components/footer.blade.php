<footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
            <h3 class="text-lg font-semibold">KEN STORE</h3>
            <p class="text-sm text-gray-300">© {{ date('Y') }} Tất cả quyền được bảo lưu.</p>
        </div>

        <div class="space-x-4 text-sm">
            <a href="{{ route('about') }}" class="hover:underline">Giới thiệu</a>
            <a href="#product" class="hover:underline">Sản phẩm</a>
            <a href="#" class="hover:underline">Liên hệ</a>
        </div>

        <div class="mt-4 md:mt-0">
            <span class="text-sm text-gray-400">Thiết kế bởi TIEN TUAN DEVELOPER</span>
        </div>
    </div>
</footer>