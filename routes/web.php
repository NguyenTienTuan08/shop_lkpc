<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

// Trang chủ dành cho Member
Route::get('/', function () {
    return view('layouts.app');
})->name('home');

// Routes đăng ký & đăng nhập
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route trang Admin Dashboard, chỉ cho Admin
Route::middleware(['auth', AdminMiddleware::class])->get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Route Quản lý người dùng, chỉ cho Admin
Route::middleware(['auth', AdminMiddleware::class])->get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');

// Route cho sửa người dùng
Route::get('/admin/users/edit/{username}', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::post('/admin/users/update/{username}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

// Route cho xóa người dùng
Route::get('/admin/users/delete/{username}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
// Route đăng xuất
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

// Route để thay đổi mật khẩu người dùng
Route::middleware(['auth', AdminMiddleware::class])->get('/admin/change-password/{username}', [AdminController::class, 'changePasswordForm'])->name('admin.changePassword');
Route::middleware(['auth', AdminMiddleware::class])->post('/admin/change-password/{username}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

// Route hiển thị form đăng sản phẩm
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.createProduct');

// Route xử lý lưu sản phẩm
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.storeProduct');


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Sửa route này
    // Route sửa sản phẩm
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');  // Sửa sản phẩm
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');    // Cập nhật sản phẩm
});

// Hiển thị danh mục sản phẩm

Route::get('/', [ProductController::class, 'showHomePage']);
Route::get('/products', [ProductController::class, 'showProducts'])->name('products.show');
Route::get('/', [ProductController::class, 'showHomePage'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/member/profile', [MemberController::class, 'showProfile'])->name('member.profile');
    Route::post('/member/update-profile', [MemberController::class, 'updateProfile'])->name('member.updateProfile');
    Route::post('/member/update-password', [MemberController::class, 'updatePassword'])->name('member.updatePassword');
});

Route::get('/gioi-thieu', function () {
    return view('components.about');
})->name('about');

Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place')->middleware('auth');
Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');
Route::get('/order/success', [OrderController::class, 'orderSuccess'])->name('order.success');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::put('/cart/update/{id}', [CartController::class, 'updateQuantityAjax'])->name('cart.update');
Route::get('/checkout-cart', [OrderController::class, 'checkoutCart'])->name('checkout.cart');

Route::get('/don-hang-cua-toi', [OrderController::class, 'showMyOrders'])->name('user.orders');
Route::post('/cancel-order/{order_id}', [OrderController::class, 'cancelOrder'])->name('cancel.order');
Route::delete('/order/delete/{id}', [App\Http\Controllers\OrderController::class, 'deleteOrder'])->name('delete.order');

// Quản lý đơn hàng
Route::get('/orders', [AdminController::class, 'showOrders'])->name('admin.orders');
Route::get('/orders/{id}', [AdminController::class, 'viewOrderDetail'])->name('admin.orders.detail');
Route::post('/orders/{id}/update', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');
Route::delete('/orders/{id}/delete', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');
