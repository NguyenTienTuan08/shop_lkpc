<script src="https://cdn.tailwindcss.com"></script>
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    @csrf
    @method('PUT')

    <h2 class="text-3xl font-bold text-gray-700 text-center mb-6">Cập nhật sản phẩm</h2>

    <div class="mb-6">
        <label for="tensanpham" class="block text-lg font-medium text-gray-700">Tên sản phẩm</label>
        <input type="text" name="tensanpham" id="tensanpham" value="{{ old('tensanpham', $product->tensanpham) }}" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
    </div>

    <div class="mb-6">
        <label for="dongia" class="block text-lg font-medium text-gray-700">Đơn giá</label>
        <input type="number" name="dongia" id="dongia" value="{{ old('dongia', $product->dongia) }}" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
    </div>

    <div class="mb-6">
        <label for="phanloai" class="block text-lg font-medium text-gray-700">Phân loại</label>
        <input type="text" name="phanloai" id="phanloai" value="{{ old('phanloai', $product->phanloai) }}" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
    </div>

    <div class="mb-6">
        <label for="status" class="block text-lg font-medium text-gray-700">Trạng thái</label>
        <select name="status" id="status" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            <option value="con_hang" {{ $product->status == 'con_hang' ? 'selected' : '' }}>Còn hàng</option>
            <option value="het_hang" {{ $product->status == 'het_hang' ? 'selected' : '' }}>Hết hàng</option>
        </select>
    </div>

    <div class="mb-6">
        <label for="hinhanh" class="block text-lg font-medium text-gray-700">Hình ảnh</label>
        <input type="file" name="hinhanh" id="hinhanh" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
    </div>

    <!-- Thông tin chi tiết sản phẩm -->
    <div class="mb-6">
        <label for="thongsokythuat" class="block text-lg font-medium text-gray-700">Thông số kỹ thuật</label>
        <textarea name="thongsokythuat" id="thongsokythuat" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('thongsokythuat', $product->productDetail->thongsokythuat ?? '') }}</textarea>
    </div>

    <div class="mb-6">
        <label for="chitietsanpham" class="block text-lg font-medium text-gray-700">Chi tiết sản phẩm</label>
        <textarea name="chitietsanpham" id="chitietsanpham" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('chitietsanpham', $product->productDetail->chitietsanpham ?? '') }}</textarea>
    </div>

    <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Cập nhật</button>
</form>