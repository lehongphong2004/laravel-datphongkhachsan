<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KhachSanController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\DatPhongController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UuDaiController;
use App\Http\Controllers\BlogDuLichController;
use App\Http\Controllers\TaiKhoanController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [KhachSanController::class, 'rating'])->name('landing'); // Trang chủ

// Khách sạn
Route::get('/user/hotels', [KhachSanController::class, 'index'])->name('user.hotels');
Route::get('/user/hotels/{id}', [KhachSanController::class, 'chiTiet'])->name('user.hotels.chitiet');
// Alias cho Blade cũ
Route::get('/user/hotels/{id}', [KhachSanController::class, 'chiTiet'])->name('user.phong.chitiet');

// Ưu đãi (frontend)
Route::get('/uudai', [UuDaiController::class, 'index'])->name('uudai.index');

// Tìm kiếm khách sạn
Route::get('/user/search', [KhachSanController::class, 'index'])->name('user.search');

// Blog du lịch
Route::get('/blog', [BlogDuLichController::class, 'index'])->name('user.blog.index');
Route::get('/blog/{id}', [BlogDuLichController::class, 'show'])->name('user.blog.show');

/*
|--------------------------------------------------------------------------
| CUSTOMER ROUTES (role: khach_hang)
|--------------------------------------------------------------------------
*/
Route::middleware(['role:khach_hang'])->prefix('user')->group(function () {
    // Bước 1: hiển thị form đặt phòng
    Route::get('/datphong/{phong_id}', [DatPhongController::class, 'show'])
        ->name('user.datphong');

    // Bước 2: nhận dữ liệu từ form, hiển thị trang thanh toán
    Route::post('/datphong/payment', [DatPhongController::class, 'payment'])
        ->name('user.datphong.payment');

    // Bước 3: xử lý thanh toán, lưu DB
    Route::post('/datphong/process', [DatPhongController::class, 'processPayment'])
        ->name('user.datphong.process');

    // Lịch sử đặt phòng
    Route::get('/lichsu', [DatPhongController::class, 'lichSu'])->name('user.lichsu');

    // Đánh giá
    Route::post('/danhgia', [DanhGiaController::class, 'store'])->name('user.danhgia.store');
     Route::get('/password/change', [AuthController::class, 'showChangePassword'])->name('user.password.form');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('user.password.change');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');

    // Quản lý khách sạn
    Route::get('/khachsan', [KhachSanController::class, 'adminIndex'])->name('admin.khachsan.index');
    Route::get('/khachsan/create', [KhachSanController::class, 'create'])->name('admin.khachsan.create');
    Route::get('/khachsan/{id}', [KhachSanController::class, 'chiTietAdmin'])->name('admin.khachsan.show');
    Route::post('/khachsan/store', [KhachSanController::class, 'store'])->name('admin.khachsan.store');
    Route::get('/khachsan/{id}/edit', [KhachSanController::class, 'edit'])->name('admin.khachsan.edit');
    Route::put('/khachsan/{id}', [KhachSanController::class, 'update'])->name('admin.khachsan.update');
    Route::delete('/khachsan/{id}', [KhachSanController::class, 'destroy'])->name('admin.khachsan.destroy');

    // Quản lý phòng
    Route::get('/phong/create/{khachsan_id}', [PhongController::class, 'create'])->name('admin.phong.create');
    Route::post('/phong/store', [PhongController::class, 'store'])->name('admin.phong.store');
    Route::get('/phong/{id}/edit', [PhongController::class, 'edit'])->name('admin.phong.edit');
    Route::put('/phong/{id}', [PhongController::class, 'update'])->name('admin.phong.update');
    Route::delete('/phong/{id}', [PhongController::class, 'destroy'])->name('admin.phong.destroy');

    // Quản lý ưu đãi
    Route::get('/uudai', [AdminController::class, 'quanLyUuDai'])->name('admin.uudai.index');
    Route::get('/uudai/create', [UuDaiController::class, 'create'])->name('admin.uudai.create');
    Route::post('/uudai/store', [UuDaiController::class, 'store'])->name('admin.uudai.store');
    Route::get('/uudai/{id}/edit', [UuDaiController::class, 'edit'])->name('admin.uudai.edit');
    Route::put('/uudai/{id}', [UuDaiController::class, 'update'])->name('admin.uudai.update');
    Route::delete('/uudai/{id}', [UuDaiController::class, 'destroy'])->name('admin.uudai.destroy');

    // Quản lý blog du lịch
    Route::get('/blog', [AdminController::class, 'quanLyBlog'])->name('admin.blog.index');
    Route::get('/blog/create', [BlogDuLichController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog/store', [BlogDuLichController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/{id}/edit', [BlogDuLichController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/blog/{id}', [BlogDuLichController::class, 'update'])->name('admin.blog.update');
    Route::delete('/blog/{id}', [BlogDuLichController::class, 'destroy'])->name('admin.blog.destroy');

    // Quản lý đơn đặt phòng (đã bỏ /admin/ thừa)
    Route::get('/donhang', [AdminController::class, 'quanLyDatPhong'])->name('admin.donhang.index');
    Route::get('/donhang/duyet/{id}', [AdminController::class, 'duyetDatPhong'])->name('admin.datphong.duyet');
    Route::get('/donhang/huy/{id}', [AdminController::class, 'huyDatPhong'])->name('admin.datphong.huy');
    Route::get('/donhang/xoa/{id}', [AdminController::class, 'xoaDatPhong'])->name('admin.datphong.xoa');
});

// Quản lý tài khoản
Route::middleware(['role:admin'])->prefix('admin/taikhoan')->name('admin.taikhoan.')->group(function () {
    Route::get('/', [TaiKhoanController::class, 'index'])->name('index');
    Route::get('/create', [TaiKhoanController::class, 'create'])->name('create');
    Route::post('/store', [TaiKhoanController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TaiKhoanController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TaiKhoanController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [TaiKhoanController::class, 'destroy'])->name('destroy');
});
