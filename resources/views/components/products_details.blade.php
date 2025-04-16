<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    @vite('resources/css/app.css') <!-- Nếu bạn dùng Vite + Tailwind -->
</head>

<body class="bg-gray-100 text-gray-800">
    @include('components.header')
    @if(session('success'))
    <div class="container mx-auto mt-6">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <br>
    <h2 class="text-4xl font-extrabold text-center text-indigo-700  ">Thông Tin Sản Phẩm</h2>
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-lg shadow-lg p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Hình ảnh sản phẩm -->
            <div>
                <img src="{{ asset('images/' . $product->hinhanh) }}" alt="{{ $product->tensanpham }}" class="rounded-lg w-full h-auto">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="space-y-4">
                <h2 class="text-3xl font-bold text-blue-700">{{ $product->tensanpham }}</h2>
                <p class="text-xl text-red-600 font-semibold">Giá: {{ number_format($product->dongia) }} VNĐ</p>

                <p class="text-md">
                    Tình Trạng:
                    @if($product->status === 'con_hang')
                    <span class="text-green-600 font-semibold">Còn hàng</span>
                    @else
                    <span class="text-red-600 font-semibold">Hết hàng</span>
                    @endif
                </p>

                <div>
                    <h3 class="text-lg font-semibold mb-2">Thông Số Kỹ Thuật:</h3>
                    <div class="bg-gray-100 p-4 rounded text-sm">
                        {!! nl2br(e($product->details->thongsokythuat)) !!}
                    </div>
                </div>

                @if($product->details->chitietsanpham)
                <div>
                    <h3 class="text-lg font-semibold mb-2">Chi Tiết Sản Phẩm:</h3>
                    <div class="bg-gray-100 p-4 rounded text-sm">
                        {!! nl2br(e($product->details->chitietsanpham)) !!}
                    </div>
                </div>
                @endif

                <!-- Nút hành động -->
                <div class="flex space-x-4 mt-6">
                    <a href="{{ route('checkout', ['id' => $product->id]) }}">
                        <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Mua Ngay</button>
                    </a>
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Thêm Giỏ Hàng
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>

</html>