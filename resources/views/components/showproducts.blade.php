@php
$currentCategory = request('category', 'all'); // Lấy danh mục đang chọn
$categoriesList = [
'all' => 'Tất Cả Sản Phẩm',
'Mainboard' => 'Mainboard',
'CPU' => 'CPU',
'VGA' => 'VGA',
'RAM' => 'RAM',
'ManHinh' => 'Màn Hình'
];
@endphp
<div class="container mx-auto mt-10"> <!-- Tiêu đề Danh Mục Sản Phẩm -->


    <div class="text-2xl font-semibold text-center mb-8">
        <h2 id="product">Danh Mục Sản Phẩm</h2>
    </div>

    <!-- Dashboard (Danh mục sản phẩm) -->
    <div class="flex justify-center space-x-4 mb-8 flex-wrap">
        @foreach($categoriesList as $key => $label)
        <a href="{{ route('home') }}?category={{ $key }}">
            <button class="px-4 py-2 text-white rounded-lg transition duration-200
                {{ $currentCategory == $key ? 'bg-blue-700' : 'bg-gray-600 hover:bg-gray-700' }}">
                {{ $label }}
            </button>
        </a>
        @endforeach
    </div>

    <!-- Grid hiển thị sản phẩm -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="p-6 bg-white shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300 flex flex-col justify-between">
            <img src="{{ asset('images/' . $product->hinhanh) }}" class="w-72 h-72 object-cover rounded-md mb-4" alt="{{ $product->tensanpham }}">
            <h3 class="text-lg font-medium text-gray-800">{{ $product->tensanpham }}</h3>
            <p class="text-gray-600 mt-2">Price: {{ number_format($product->dongia) }} VNĐ</p>
            <p class="text-sm text-gray-500 mt-2">
                Tình Trạng:
                @if($product->status == 'con_hang')
                <span class="text-green-600 font-semibold">Còn hàng</span>
                @else
                <span class="text-red-600 font-semibold">Hết hàng</span>
                @endif
            </p>
            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('checkout', ['id' => $product->id]) }}"><button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Mua Ngay</button></a>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Giỏ Hàng
                    </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>
    {{-- Hiển thị thông báo thêm giỏ hàng thành công --}}
    @if(session('success'))
    <div id="toast-success" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
            bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg z-50 text-center">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 5000); // Ẩn sau 2 giây
    </script>
    @endif
</div>