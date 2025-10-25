<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị trang login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý login
    public function login(Request $request)
    {
        $request->validate([
            'ten_dang_nhap' => 'required',
            'mat_khau' => 'required',
        ]);

        $user = TaiKhoan::where('ten_dang_nhap', $request->ten_dang_nhap)->first();

        // Kiểm tra tài khoản và mật khẩu đúng (so sánh bằng Hash::check)
        if ($user && Hash::check($request->mat_khau, $user->mat_khau)) {
            // Lấy thông tin người dùng
            $nguoiDung = NguoiDung::where('taikhoan_id', $user->taikhoan_id)->first();

            // Lưu session
            session([
                'taikhoan_id' => $user->taikhoan_id,
                'vai_tro' => $user->vai_tro,
                'nguoidung_id' => $nguoiDung ? $nguoiDung->nguoidung_id : null,
                'ten_dang_nhap' => $user->ten_dang_nhap,
            ]);

            // Điều hướng theo vai trò
            if ($user->vai_tro === 'admin') {
                return redirect()->route('admin.home');
            }

            return redirect()->route('user.hotels');
        }

        return back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu!');
    }

    // Logout
    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    // Hiển thị trang đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'ten_dang_nhap' => 'required|unique:taikhoan',
            'mat_khau' => 'required|min:6',
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:nguoidung',
        ]);

        //  Mã hóa mật khẩu trước khi lưu
        $tk = TaiKhoan::create([
            'ten_dang_nhap' => $request->ten_dang_nhap,
            'mat_khau' => Hash::make($request->mat_khau),
            'vai_tro' => 'khach_hang',
        ]);

        NguoiDung::create([
            'taikhoan_id' => $tk->taikhoan_id,
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy đăng nhập để tiếp tục.');
    }
    // Hiển thị form đổi mật khẩu
    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    // Xử lý đổi mật khẩu
    public function changePassword(Request $request)
    {
        $request->validate([
            'mat_khau_cu' => 'required',
            'mat_khau_moi' => 'required|min:6|confirmed',
        ]);

        $user = TaiKhoan::find(session('taikhoan_id'));

        if (!$user || !Hash::check($request->mat_khau_cu, $user->mat_khau)) {
            return back()->with('error', 'Mật khẩu cũ không đúng!');
        }

        $user->mat_khau = Hash::make($request->mat_khau_moi);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

}
