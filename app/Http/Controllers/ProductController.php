<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Category;


class ProductController extends Controller
{
    // Hiển thị form đăng sản phẩm
    public function create()
    {
        return view('admin.create-product');
    }

    // Lưu sản phẩm vào database
    public function store(Request $request)
    {
        // Validate đầu vào
        $request->validate([
            'danhmuc' => 'required|in:Mainboard,CPU,RAM,SSD,VGA,Case,ManHinh', // Validate danh mục
            'image' => 'required|image', // Kiểm tra hình ảnh
            'name' => 'required|string|max:255', // Kiểm tra tên sản phẩm
            'price' => 'required|numeric', // Kiểm tra giá sản phẩm
            'specifications' => 'nullable|string', // Thông số kỹ thuật sản phẩm
            'description' => 'nullable|string', // Chi tiết sản phẩm
            'status' => 'required|in:con_hang,het_hang', // Kiểm tra trạng thái
        ]);

        // Lưu hình ảnh vào thư mục public/products
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension(); // đặt tên theo thời gian
            $file->move(public_path('images'), $filename); // lưu trực tiếp vào public/images

            // lưu tên ảnh vào DB (ví dụ: 1743783507.jpg)
        }



        // Lưu vào bảng products
        $product = new Product();
        $product->danhmuc = $request->danhmuc; // Danh mục sản phẩm
        $product->hinhanh = $filename; // Lưu tên file hình ảnh
        $product->tensanpham = $request->name; // Tên sản phẩm
        $product->dongia = $request->price; // Đơn giá
        $product->phanloai = $request->phanloai; // Phân loại sản phẩm
        $product->status = $request->status; // Trạng thái sản phẩm
        $product->save(); // Lưu vào database

        // Lưu chi tiết sản phẩm vào bảng product_details (nếu có thông số kỹ thuật và mô tả)
        if ($request->has('specifications') || $request->has('description')) {
            $productDetail = new ProductDetail();
            $productDetail->product_id = $product->id; // Liên kết với sản phẩm vừa tạo
            $productDetail->thongsokythuat = $request->specifications; // Thông số kỹ thuật
            $productDetail->chitietsanpham = $request->description; // Chi tiết sản phẩm
            $productDetail->save(); // Lưu vào bảng product_details
        }

        // Redirect về form đăng sản phẩm với thông báo thành công
        return redirect()->route('admin.createProduct')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    public function index()
    {
        $products = Product::all(); // hoặc phân trang
        return view('admin.products.index', compact('products'));
    }
    public function destroy($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::find($id);

        if ($product) {
            // Xoá sản phẩm
            $product->delete();

            return redirect()->route('admin.products')->with('success', 'Sản phẩm đã được xoá');
        } else {
            return redirect()->route('admin.products')->with('error', 'Sản phẩm không tồn tại');
        }
    }
    public function edit($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Trả về view với sản phẩm cần sửa
        return view('admin.products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'tensanpham' => 'required|string|max:255',
            'dongia' => 'required|numeric',
            'phanloai' => 'required|string|max:255',
            'status' => 'required|in:con_hang,het_hang',
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thongsokythuat' => 'nullable|string',
            'chitietsanpham' => 'nullable|string',
        ]);

        // Lấy sản phẩm chính theo ID
        $product = Product::findOrFail($id);

        // Cập nhật thông tin sản phẩm
        $product->tensanpham = $validated['tensanpham'];
        $product->dongia = $validated['dongia'];
        $product->phanloai = $validated['phanloai'];
        $product->status = $validated['status'];

        // Kiểm tra và xử lý upload ảnh mới
        if ($request->hasFile('hinhanh')) {
            // Xử lý file ảnh
            $imageName = time() . '.' . $request->hinhanh->extension();
            $request->hinhanh->move(public_path('images'), $imageName);
            $product->hinhanh = $imageName;
        }

        // Lưu sản phẩm đã cập nhật
        $product->save();

        // Cập nhật chi tiết sản phẩm nếu có
        $productDetail = ProductDetail::where('product_id', $id)->first();
        if ($productDetail) {
            $productDetail->thongsokythuat = $validated['thongsokythuat'] ?? $productDetail->thongsokythuat;
            $productDetail->chitietsanpham = $validated['chitietsanpham'] ?? $productDetail->chitietsanpham;
            $productDetail->save();
        }

        // Quay lại trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('admin.products')->with('success', 'Sản phẩm và chi tiết sản phẩm đã được cập nhật thành công!');
    }

    public function showHomePage(Request $request)
    {
        // Lấy tham số 'category' từ request, mặc định là 'all' (tất cả sản phẩm)
        $category = $request->input('category', 'all');

        // Lấy tất cả các danh mục sản phẩm
        $categories = Product::select('danhmuc')->distinct()->get(); // Lấy danh sách tất cả các danh mục

        // Lọc sản phẩm theo category, nếu category là 'all', lấy tất cả sản phẩm
        if ($category === 'all') {
            $products = Product::all(); // Lấy tất cả sản phẩm
        } else {
            // Lọc sản phẩm theo danh mục
            $products = Product::where('danhmuc', $category)->get();
        }

        // Truyền dữ liệu vào view trang chủ
        return view('layouts.app', compact('categories', 'products'));
    }

    public function showDetails($id)
    {
        $product = Product::with('details')->findOrFail($id);
        return view('components.products_details', compact('product'));
    }
}
